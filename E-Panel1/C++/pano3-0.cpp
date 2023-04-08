/*  Crée et adapté par Logan MAURIN 
 *  Code pour le fonctionnement et l'envois de trame d'un PC au panneau CONRAD
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <windows.h>

#define DEBUG_PANNEAU 

#define PORT            "COM5" // cf. gestionnaire de périphériques

// Ces constantes définissent les tailles maximales pour la trame de données et pour la réponse

#define LG_MAX_TRAME    128
#define LG_MAX          16
#define LG_REPONSE      4 // au minimum 3 caractères pour ACK

#define NUL             0x00 // caractère NUL (c'est aussi le code du fin de chaîne)
#define ACK             0x06 // accusé réception positif
#define NACK            0x15 // accusé réception négatif

// Cette constante détermine le temps d'attente avant la transmission de données.

#define DELAI           1 // en secondes


HANDLE ouvrirPort(char *nomPort)
{
    HANDLE hPort = INVALID_HANDLE_VALUE; // Handle sur le port série
    DCB old_dcb; // anciens parametres du port série
    DCB dcb; // parametres du port série
    COMMTIMEOUTS comout = {0}; // timeout du port serie ici = MODE BLOQUANT
    COMMTIMEOUTS oldTimeouts; // ancien timeout du port série
    char nomPeripherique[LG_MAX] = { PORT };
    

     // Construction du nom complet du périphérique avec \\.\ devant le nom du port
    sprintf(nomPeripherique, "\\\\.\\%s", nomPort);

    // Ouverture du port série
    hPort = CreateFile(
                       "\\\\.\\COM5",     
                       GENERIC_READ | GENERIC_WRITE,          
                       0,                  
                       NULL,               
                       OPEN_EXISTING,      
                       0,                  
                       NULL);

    // Vérification si l'ouverture du port série s'est bien déroulée
    if( hPort == INVALID_HANDLE_VALUE )
    {
        fprintf(stderr, "Erreur d'ouverture du peripherique %s !\n", nomPeripherique);
        return hPort;
    }

    /* Lecture des parametres courants  */
    GetCommState(hPort, &dcb);
    old_dcb = dcb; // sauvegarde l'ancienne configuration

    /* Liaison a 9600 bps, 8 bits de donnees, pas de parite, lecture possible */
    dcb.BaudRate = CBR_9600;
    dcb.ByteSize = 8;
    dcb.StopBits = ONESTOPBIT;
    dcb.Parity = NOPARITY;
    dcb.fBinary = TRUE;
    /* pas de control de flux */
    dcb.fOutxCtsFlow = FALSE;
    dcb.fOutxDsrFlow = FALSE;

    /* Sauvegarde des nouveaux parametres */
    if( !SetCommState(hPort, &dcb) )
    {
      fprintf(stderr, "Impossible de configurer le port %s !", nomPort);
      CloseHandle(hPort);
      return hPort;
    }
    // Configuration de la taille du buffer d'entrée/sortie (2048 octets reception, 1024 octets émission)
    SetupComm(hPort, 2048, 1024);
    // Sauvegarde des anciens paramètres de timeout
    GetCommTimeouts(hPort, &oldTimeouts);
    // Configuration des nouveaux paramètres de timeout pour le mode non bloquant
    comout.ReadIntervalTimeout = 100;       // Temps d'attente entre deux caractères de la trame reçue (en ms)
    comout.ReadTotalTimeoutMultiplier = 1;  // Temps d'attente total (multiplié par le nombre de caractères à lire
    comout.ReadTotalTimeoutConstant = 0;    // Temps d'attente constant (ajouté au temps total)
    SetCommTimeouts(hPort, &comout);        // Applique les nouveaux paramètres de timeout au port série
    
    return hPort;   // Renvoie le handle sur le port série
}

void fermerPort(HANDLE hPort)
{
    // Fermeture du handle sur le port série
    CloseHandle(hPort);
}

BOOL envoyer(HANDLE hPort, char *trame, int nb)
{
    BOOL retour = FALSE;                // Variable pour stocker le résultat de l'opération d'écriture
    DWORD nNumberOfBytesToWrite = nb;   // Nombre d'octets à écrire dans le port série
    DWORD ecrits;                       // Nombre d'octets réellement écrits dans le port série   

     // Vérifier que le handle du port série est valide
    if(hPort > 0)
    {
        // Écrire les octets de la trame dans le port série
        retour = WriteFile(hPort, trame, nNumberOfBytesToWrite, &ecrits, NULL);
        
        // Si le mode de débogage est activé, afficher des informations sur la trame envoyée
        #ifdef DEBUG_PANNEAU        
        //debug : affichage
        fprintf(stderr, "-> envoyer (%d/%d) : ", nb, ecrits);
        //fprintf(stderr, "trame : ");
        /*int i; 
        for(i=0;i<nb;i++)
        {
            fprintf(stderr, "0x%02X ", *(trame+i));
        }
        fprintf(stderr, "\n");*/
        fprintf(stderr, "%s\n", trame);
        #endif

         // Si l'écriture a échoué, afficher un message d'erreur
        if (retour == FALSE)
        {
            fprintf(stderr, "Erreur écriture port !");
        }
    }
    else 
    {
        #ifdef DEBUG_PANNEAU
        //debug : affichage
        fprintf(stderr, "-> envoyer (%d) : ERREUR port !\n", nb);
        fprintf(stderr, "trame : ");
        /*int i; 
        for(i=0;i<nb;i++)
        {
            fprintf(stderr, "0x%02X ", *(trame+i));
        }
        fprintf(stderr, "\n");*/
        fprintf(stderr, "%s\n", trame);
        #endif
    }

    return retour;
}


// Cette fonction permet de recevoir des données à partir d'un port série et de les stocker dans un tampon de données.
BOOL recevoir(HANDLE hPort, char *donnees, int nb)
{
    char donnee;
    int n;
    DWORD lus = 0;
    BOOL retour = FALSE;
    
    // Vérifie que le port série et le tampon de données sont valides
    if(hPort > 0 && donnees != (char *)NULL)
    {
        // Vérifie que la taille du tampon de données est supérieure à 0
        if(nb > 0)
        {
            // Boucle pour recevoir "nb" octets de données
            for(n=0;n<nb;n++)
            {
                // Lit un octet à partir du port série en utilisant la fonction "ReadFile"             
                // ATTENTION au mode bloquant !
                retour = ReadFile(hPort, &donnee, 1, &lus, NULL);
                if(retour == TRUE)
                {
                     // Stocke la donnée lue dans le tampon de données à la position "n"
                    if(donnee != 0)
                    {
                        *(donnees+n) = donnee;
                        fprintf(stderr, "donnee : 0x%02X (%d)\n", *(donnees+n), n); 
                    }
                    else n--; // Si la donnée lue est égale à 0, décrémente "n" pour la supprimer du tampon
                }
                else    
                {
                    break; // Si la lecture échoue, arrête la boucle
                }
            }
             // Ajoute un caractère nul au tampon de données pour indiquer la fin de la chaîne
            *(donnees+n) = 0x00; //fin de chaine
             // Affiche le contenu du tampon de données en format hexadécimal si la macro DEBUG_PANNEAU est définie
            #ifdef DEBUG_PANNEAU
            int i;
            fprintf(stderr, "<- recevoir (%d/%d) : ", nb, n);
            //fprintf(stderr, "trame : ");
            for(i=0;i<nb;i++)
                fprintf(stderr, "0x%02X ", *(donnees+i)); 
            fprintf(stderr, "\n"); 
            #endif
        }
        else
        {
            // Si la taille du tampon de données est nulle, ne fait rien
        }
    }
    
    return retour;
}

unsigned char calculerChecksum(char *trame)
{
   unsigned char checksum = 0;  // initialisation du checksum à 0
   int i = 0;                   // initialisation de la variable i à 0
   
   #ifdef DEBUG_PANNEAU
   printf("data packet :\t");
   for(i=0;i<strlen(trame);i++)
      printf("0x%02X ", trame[i]);
   printf("\n");
   #endif
   
   for(i=0;i<strlen(trame);i++) // parcours de la trame
      checksum ^= trame[i];     // application de l'opérateur XOR au checksum et au caractère courant

   #ifdef DEBUG_PANNEAU 
   printf("checksum :\t0x%02X\n", checksum);
   #endif
   
   return checksum; // retourne le checksum calculé
}

// Cette fonction envoie un message via le port série, attend une réponse et la stocke dans une variable
void envoyerEtRecevoirTrame(char *message, char *nomPort, char *reponse)
{
    char trame[LG_MAX_TRAME] = { NUL };                         // Initialise un tableau de caractères pour la trame
    char protocole[LG_MAX_TRAME] = "<L1><PA><FE><MA><WC><FE>";  // Initialise un en-tête de trame
    unsigned char checksum;                                     // Initialise une variable pour stocker le checksum calculé 
    BOOL retour = FALSE;                                        // Initialise une variable booléenne pour vérifier le succès des opérations
    HANDLE hPort = INVALID_HANDLE_VALUE;                        // Initialise une variable pour stocker le handle du port série
    
    // 0. on ajoute le message dans l'en-tete du protocole
    sprintf(protocole, "%s%s", protocole, message);
    
    // 1. on calcule le checksum de la trame
    checksum = calculerChecksum(protocole);
    
    // 2. on fabrique la trame
    sprintf(trame, "<ID01>%s%02X<E>", protocole, checksum);
    
    // 3. on transfere la trame
    
    // 3.1 on ouvre le port
    hPort = ouvrirPort(nomPort);
    if(hPort == INVALID_HANDLE_VALUE)
    {
        fprintf(stderr, "Erreur ouverture !\n");
        //return fd;
    }
    
    // 3.2 on envoie la trame
    retour = envoyer(hPort, &trame[0], strlen(trame));
    if(retour == FALSE)
    {
        fprintf(stderr, "Erreur transmission !\n");
        // ... ?
    }
 
    Sleep(DELAI); // Attend un court instant pour que la réponse puisse arriver
 
    // 3.3 on receptionne l'acquittement
    retour = recevoir(hPort, reponse, LG_REPONSE);
    if(retour == FALSE)
    {
        fprintf(stderr, "Erreur reception !\n");
        // ... ?
    }
    else
    {
        printf("Reponse : %s\n", reponse);
    }
    
    // 3.4 on ferme le port
    fermerPort(hPort);
}

int main(int argc, char *argv[])
{   
    char trame[LG_MAX_TRAME] = { NUL };                         // Initialise un tableau de caractères pour la trame
    char protocole[LG_MAX_TRAME] = "<L1><PA><FE><MA><WC><FE>";  // Initialise un en-tête de trame
    unsigned char checksum;                                     // Initialise une variable pour stocker le checksum calculé 
    BOOL retour = FALSE;                                        // Initialise une variable booléenne pour vérifier le succès des opérations
    HANDLE hPort = INVALID_HANDLE_VALUE;                        // Initialise une variable pour stocker le handle du port série
    char message[LG_MAX];                                       // Message a envoyer
    char nomPort[] = "COM6";                                    // Nom du port série à utiliser
    char reponse[LG_REPONSE];                                   // Réponse reçue du port série
    
    // Si le nombre d'arguments est égal à 2
    if (argc == 2) {
        // Copie le deuxième argument dans la variable message
        strcpy(message, argv[1]);
        // Appel de la fonction envoyerEtRecevoirTrame avec les paramètres message, nomPort et reponse
        envoyerEtRecevoirTrame(message, nomPort, reponse); 
    }
}
