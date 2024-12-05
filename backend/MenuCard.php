<?php
class MenuCard {
    public $title;
    public $description;
    public $price;
    public $image;

    public function __construct($title, $description, $price, $image) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }

    public function generateCardHTML() {
        return "
            <div class='col'>
                <div class='card'>
                    <img src='{$this->image}' class='card-img-top' alt='{$this->title}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$this->title}</h5>
                        <p class='card-text'>{$this->description}</p>
                        <p><strong>{$this->price}</strong></p>
                    </div>
                </div>
            </div>
        ";
    }
}

// Array of menu items
$menuItems = [
    new MenuCard("Cappuccino", "A perfect blend of espresso and steamed milk.", "$5.00", "../images/xyzcharlize-nMaynn82WZ0-unsplash (1).jpg"),
    new MenuCard("Chocolate Cake", "A rich, indulgent slice of chocolate heaven.", "$3.50", "../images/douglas-lopez-OADLv4BPWUg-unsplash.jpg"),
    new MenuCard("Strawberry Smoothie", "A refreshing smoothie made with fresh strawberries.", "$4.00", "../images/bakd-raw-by-karolin-baitinger-XKqIOpMMTOQ-unsplash.jpg")
];
?>
