<?php

// Fonction pour ajouter un message flash dans la session
function addFlashMessage(string $message, string $type = 'success') {
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }
    $_SESSION['flash_messages'][] = [
        'message' => $message,
        'type' => $type
    ];
}

// Fonction pour afficher les messages flash et les supprimer de la session
function displayFlashMessages() {
    if (isset($_SESSION['flash_messages'])) {
        foreach ($_SESSION['flash_messages'] as $message) {
            echo '<div class="flash-' . $message['type'] . '">' . $message['message'] . '</div>';
        }
        unset($_SESSION['flash_messages']);
    }
}

function canProceed() {
    if (!isset($_SESSION['flash_messages'])) {
        return true;
    }
    foreach ($_SESSION['flash_messages'] as $message) {
        if ($message['type'] == 'error') {
            return false;
        }
    }
    return true;
}

/*
 * Pour utiliser ces fonctions, vous devez d'abord démarrer une session en appelant session_start() en haut de votre script.
 * Ensuite, vous pouvez utiliser la fonction addFlashMessage pour ajouter un message dans la session, comme ceci :
 *      addFlashMessage('Le message a été envoyé avec succès', 'success');
 */

/*
 * Pour afficher les messages flash, vous pouvez utiliser la fonction displayFlashMessages dans votre template de vue, comme ceci :
 * <?php displayFlashMessages(); ?>
 */