<?php

$categories = array(
    "Matematyka" => array(
        array(
            "question" => "Ile to jest 2 + 2?",
            "options" => array("3", "4", "5"),
            "correct" => "4"
        ),
        array(
            "question" => "Jakie jest pierwiastkowanie liczby 81?",
            "options" => array("7", "9", "6"),
            "correct" => "9"
        ),
        array(
            "question" => "Jak nazywa się figura geometryczna o ośmiu bokach?",
            "options" => array("Oktagon", "Hexagon", "Heptagon"),
            "correct" => "Oktagon"
        ),
        array(
            "question" => "Ile wynosi 5 do potęgi 3?",
            "options" => array("15", "125", "25"),
            "correct" => "125"
        ),
        array(
            "question" => "Jaki jest pierwiastek kwadratowy z 144?",
            "options" => array("11", "12", "13"),
            "correct" => "12"
        ),
        // Dodaj więcej pytań z kategorii matematyki
    ),
    "Programowanie" => array(
        array(
            "question" => "Jakiego języka programowania używa się do tworzenia stron internetowych?",
            "options" => array("PHP", "JavaScript", "C++"),
            "correct" => "PHP"
        ),
        array(
            "question" => "Co oznacza skrót HTML?",
            "options" => array("Hyper Text Markup Language", "Highly Technical Markup Language", "Home Tool Markup Language"),
            "correct" => "Hyper Text Markup Language"
        ),
        array(
            "question" => "Co to jest CSS?",
            "options" => array("Język programowania", "Arkusz stylów", "Framework"),
            "correct" => "Arkusz stylów"
        ),
        array(
            "question" => "Jak nazywa się język do zapytań do bazy danych?",
            "options" => array("SQL", "HTML", "PHP"),
            "correct" => "SQL"
        ),
        array(
            "question" => "Jaka jest różnica między HTML a CSS?",
            "options" => array("HTML jest językiem programowania, a CSS jest arkuszem stylów", "HTML definiuje strukturę strony, a CSS jest używany do stylizacji", "HTML jest używany do backendu, a CSS do frontendu"),
            "correct" => "HTML definiuje strukturę strony, a CSS jest używany do stylizacji"
        ),
        // Dodaj więcej pytań z kategorii programowania
    ),
    "Biologia" => array(
        array(
            "question" => "Jak nazywa się nauka o organizmach żywych?",
            "options" => array("Biologia", "Chemia", "Fizyka"),
            "correct" => "Biologia"
        ),
        array(
            "question" => "Co to jest fotosynteza?",
            "options" => array("Proces oddychania roślin", "Proces trawienia roślin", "Proces wytwarzania substancji organicznych przez rośliny"),
            "correct" => "Proces wytwarzania substancji organicznych przez rośliny"
        ),
        array(
            "question" => "Jaki jest największy organ człowieka?",
            "options" => array("Wątroba", "Skóra", "Mózg"),
            "correct" => "Skóra"
        ),
        array(
            "question" => "Co to jest DNA?",
            "options" => array("Kwas nukleinowy", "Hormon", "Enzym"),
            "correct" => "Kwas nukleinowy"
        ),
        array(
            "question" => "Jak nazywa się proces podziału komórki?",
            "options" => array("Fotosynteza", "Mitosis", "Mejoza"),
            "correct" => "Mitosis"
        ),
    ),
    "Geografia" => array(
        array(
            "question" => "Który kontynent jest największy pod względem powierzchni?",
            "options" => array("Azja", "Afryka", "Ameryka Północna"),
            "correct" => "Azja"
        ),
        array(
            "question" => "Jaka jest najwyższa góra na świecie?",
            "options" => array("Mount Everest", "K2", "Kangchenjunga"),
            "correct" => "Mount Everest"
        ),
        array(
            "question" => "W którym kraju znajduje się Wielki Kanion Kolorado?",
            "options" => array("USA", "Kanada", "Meksyk"),
            "correct" => "USA"
        ),
        array(
            "question" => "Gdzie znajduje się Wielki Barierny Rafa koralowa?",
            "options" => array("Ocean Atlantycki", "Morze Śródziemne", "Ocean Spokojny"),
            "correct" => "Ocean Spokojny"
        ),
        array(
            "question" => "Jaki kraj posiada największą powierzchnię lodowca?",
            "options" => array("Norwegia", "Rosja", "Islandia"),
            "correct" => "Rosja"
        ),
    )
);

foreach ($categories as &$category) {
    foreach ($category as &$question) {
        shuffle($question['options']);
    }
}

unset($category);