<?php
class HTMLDOM {
    private $dom;

    public function __construct($html) {
        $this->dom = new DOMDocument();
        @$this->dom->loadHTML($html); // Suppress warnings for invalid HTML
    }

    public function getElementById($id) {
        return $this->dom->getElementById($id);
    }

    public function getElementsByTagName($tagName) {
        return $this->dom->getElementsByTagName($tagName);
    }

    public function createElement($tagName, $content = null) {
        $element = $this->dom->createElement($tagName, $content);
        return $element;
    }

    public function appendChild($parent, $child) {
        $parent->appendChild($child);
    }

    public function removeChild($parent, $child) {
        $parent->removeChild($child);
    }

    public function saveHTML() {
        return $this->dom->saveHTML();
    }
}

// Example usage
$html = '<div id="myDiv"><p>Hello, <span>world!</span></p></div>';
$dom = new HTMLDOM($html);

$div = $dom->getElementById('myDiv');
$span = $dom->getElementsByTagName('span')->item(0);

$newSpan = $dom->createElement('span', 'Universe!');
$dom->appendChild($div, $newSpan);
$dom->removeChild($div, $span);

echo $dom->saveHTML();
