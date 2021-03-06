<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\Item;
use Model\ItemManager;

/**
 * Class ItemController
 *
 */
class ItemController extends AbstractController
{

    /**
     * Display item listing
     *
     * @return string
     */
    public function index()
    {
        $itemManager = new ItemManager();
        $items = $itemManager->selectAll();

        return $this->twig->render('Item/index.html.twig', ['items' => $items]);
    }

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     *
     * @return string
     */
    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     *
     * @return string
     */
    public function edit(int $id)
    {
        // TODO : edit item with id $id
        return $this->twig->render('Item/edit.html.twig', ['item', $id]);
    }

    /**
     * Display item creation page
     *
     * @return string
     */
    public function add()
    {
        // si form soumis
        $errors = [];
        if (!empty($_POST)) {
            // validation des données

            if (empty(trim($_POST['title']))) {
                $errors[] = 'Le champ ne doit être vide';
            }
            if (strlen($_POST['title']) > 255) {
                $errors[] = 'Le champ est trop long';
            }

            // si pas d'erreur
            if (empty($errors)) {
                // insert en bdd
                $data['title'] = trim($_POST['title']);

                $itemManager = new ItemManager();
                $itemManager->insert($data);

                // redirect vers index
                header('Location: /item/list');
                exit();
            }
        }

        return $this->twig->render('Item/add.html.twig', ['errors' => $errors]);
    }

    /**
     * Display item delete page
     *
     * @param int $id
     *
     * @return string
     */
    public function delete(int $id)
    {
        // TODO : delete the item with id $id
        return $this->twig->render('Item/index.html.twig');
    }
}
