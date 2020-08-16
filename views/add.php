<?php include 'partial/head.php' ?>
<body>
    <header>
        <h1>The Bouquiniste</h1>
        <nav>
            <ul class="nav__links">
                <li><a href="/">strona główna</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    
                    <div id="containsLettersWarn" class="box box-danger">
                        <p>Pole 'Rok' może zawierać TYLKO cyfry!</p>
                    </div>
                    <div id="tooLongWarn" class="box box-danger">
                        <p>Pole 'Rok' może zawierać MAKSYMALNIE 4 cyfry!</p>
                    </div>

                    <?php if (isset($_SESSION['response'])): ?>
                        <?php if ($_SESSION['response'] == true): ?>
                            
                            <div class="box box-success">
                                <p>Książkę dodano pomyślnie!</p>
                            </div>

                        <?php else: ?>

                            <div class="box box-danger">
                                <p>Wystąpił błąd podczas dodawania książki!</p>
                            </div>

                        <?php endif; ?>
                    <?php endif; ?>

                    <?php unset($_SESSION['response']); ?>

                    <form id="addForm" action="addItem" method="POST" onsubmit="event.preventDefault(); checkValid();">

                        <h2>Dodaj książkę</h2>
                        <hr>

                        <label for="title">Tytuł: </label>
                        <input type="text" name="title" required><br>
                        <label for="author">Autor: </label>
                        <input type="text" name="author" required><br>
                        <label for="genre">Gatunek: </label>
                        <input type="text" name="genre" required><br>
                        <label for="year">Rok: </label>
                        <input type="text" name="year" id="yearInput" required>
                        <label for="condition">Stan: </label>
                        <select name="condition" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        
                        <input class="form-action-btn" type="reset" value="Wyczyść pola">
                        <input class="form-action-btn fab-submit" type="submit" value="Dodaj książkę">
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="../static/js/addingControl.js"></script>
</html>