# Tudáspiac Értékelés Elementor Carousel

Ez a projekt egy egyedi Elementor carousel komponenst biztosít az okosotthon.guru weboldal számára, amely dinamikusan húzza be a smart-home.guru oldalról az értékeléseket. A komponens célja, hogy a hosszú értékelések görgethetőek legyenek, és a design jobban illeszkedjen az okosotthon.guru oldal megjelenéséhez.

## Fájlok

*   `tes/proxy-reviews.php`: Egy PHP proxy script, amely lekérdezi a smart-home.guru értékeléseit, feldolgozza azokat, és JSON formátumban szolgáltatja.
*   `reviews.html`: A HTML struktúrát és a JavaScript kódot tartalmazza, amely dinamikusan feltölti a carousel-t az értékelésekkel.
*   `reviews.css`: A komponens stílusait tartalmazza, beleértve a görgethető kártyák és az egységes magasság beállításait.

## Telepítés és Használat

### 1. PHP Proxy Script telepítése

1.  Töltse le a `tes/proxy-reviews.php` fájlt a repository-ból.
2.  Töltse fel ezt a fájlt az okosotthon.guru szerverére, egy `tes` nevű könyvtárba, hogy elérhető legyen a `https://okosotthon.guru/tes/proxy-reviews.php` URL-en.
3.  **FONTOS:** Ellenőrizze és szükség esetén módosítsa a PHP scriptben lévő XPath szelektorokat a `https://smart-home.guru/review/latestreviews` oldal aktuális HTML struktúrájához, hogy az adatok helyesen kerüljenek kinyerésre.

### 2. HTML és JavaScript kód beillesztése az Elementorba

1.  Távolítsa el a régi `iframe` kódot az Elementor oldaláról, ha még létezik:
    ```html
    &lt;iframe id="latestReviews-0" src="https://smart-home.guru/review/latestreviews" allowtransparency="true" frameborder="0" style="width:1px;min-width:100%;" scrolling="no"&gt;&lt;/iframe&gt;&lt;script src="https://smart-home.guru/js/util/iframe-resizer-util.js"&gt;&lt;/script&gt;
    ```
2.  Töltse le a `reviews.html` fájlt a repository-ból.
3.  Hozzon létre egy új "HTML" widgetet az Elementorban, és illessze be a `reviews.html` tartalmát.
4.  A JavaScript kódban a `fetch` URL-je már frissítve lett a `https://okosotthon.guru/tes/proxy-reviews.php` címre.

### 3. CSS kód beillesztése az Elementorba

1.  Töltse le a `reviews.css` fájlt a repository-ból.
2.  Lépjen az Elementor szerkesztőben az oldal vagy a szekció "Haladó" fülére, és az "Egyedi CSS" mezőbe illessze be a `reviews.css` tartalmát.
3.  Tesztelje az oldalt, és szükség esetén módosítsa a `min-height` értékét a `.reviews-carousel-wrapper` osztályban a CSS-ben, hogy a carousel magassága megfeleljen az elvárásainak.

## Licenc

Ez a projekt az MIT licenc alatt áll. További részletekért lásd a `LICENSE` fájlt.
