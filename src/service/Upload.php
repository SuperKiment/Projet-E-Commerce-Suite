<?php
function VerifyImageName($image, $uploads)
{

    $file_name = null;

    $file_upload = explode(".", $image['name']);
    // Vérification de l'extension
    if (in_array($file_upload[count($file_upload) - 1], $uploads['extensions'])) {
        // Nettoyage des accents
        $file_name = strtr(
            $file_upload[0],
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
        );
        // Nettoyage des caractères spéciaux
        $file_name = preg_replace('/([^.a-z0-9]+)/i', '_', $file_name);
        $file_name = $file_name . '.' . $file_upload[count($file_upload) - 1];
        $file_path = $uploads['path'] . $file_name;
        if (!file_exists($file_path)) {
            // Déplacement du fichier
            move_uploaded_file($image['tmp_name'], $file_path);
            $uploads['state'] = true;
        } else {
            $msg['state'] = False;
            $msg['msg'] = "Une image avec ce nom existe déjà !";
            return $msg;
        }
    } else {
        $msg['state'] = False;
        $msg['msg'] = "L'extension du fichier n'est pas acceptée !";
        return $msg;
    }

    $res = [
        "state" => True,
        "file" => $file_name
    ];
    return $res;
}
