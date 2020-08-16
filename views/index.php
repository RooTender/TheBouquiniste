<?php include 'partial/head.php' ?>
<body>
    <header>
        <h1>The Bouquiniste</h1>
        <nav>
            <ul class="nav__links">
                <li><a href="/">strona główna</a></li>
                <li><a class="success" href="/add">dodaj</a></li>
                <li><input class="danger textify" type="submit" name="delete_btn" value="usuń" form="bookList"></li>
                <li><a class="info" href="/search">szukaj</a></li>
                <li><a class="info" href="/export">eksportuj</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">

                <h2>Strona główna</h2>
                <hr>

                <form id="bookList" action="formEvent" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tytuł <a href="?page=<?php echo $page ?>&&order=asc&&by=title" class="sort-btn">&#9651;</a> <a href="?page=<?php echo $page ?>&&order=desc&&by=title" class="sort-btn">&#9661;</a></th>
                                <th>Autor <a href="?page=<?php echo $page ?>&&order=asc&&by=author" class="sort-btn">&#9651;</a> <a href="?page=<?php echo $page ?>&&order=desc&&by=author" class="sort-btn">&#9661;</a></th>
                                <th>Gatunek <a href="?page=<?php echo $page ?>&&order=asc&&by=genre" class="sort-btn">&#9651;</a> <a href="?page=<?php echo $page ?>&&order=desc&&by=genre" class="sort-btn">&#9661;</a></th>
                                <th>Rok <a href="?page=<?php echo $page ?>&&order=asc&&by=year" class="sort-btn">&#9651;</a> <a href="?page=<?php echo $page ?>&&order=desc&&by=year" class="sort-btn">&#9661;</a></th>
                                <th>Stan <a href="?page=<?php echo $page ?>&&order=asc&&by=condition" class="sort-btn">&#9651;</a> <a href="?page=<?php echo $page ?>&&order=desc&&by=condition" class="sort-btn">&#9661;</a></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (is_array($books) && !empty($books)): ?>
                                <?php foreach ($books as $book): ?>
                                    
                                <tr>
                                    <td><input type="checkbox" name="id[]" value="<?php echo $book["id"]?>" /></td>
                                    <td><?php echo $book["title"] ?></td>
                                    <td><?php echo $book["author"] ?></td>
                                    <td><?php echo $book["genre"] ?></td>
                                    <td><?php echo $book["year"] ?></td>
                                    <td><?php echo $book["condition"] ?></td>
                                </tr>

                                <?php endforeach; ?>
                            
                                <?php else: ?>
                                    <div class="box box-info">
                                        <p>Baza danych jest pusta!</p>
                                    </div>

                            <?php endif; ?>

                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
            <div class="row paging">
                <div class="col-1">
                    <?php if (isset($page) && $page != 1): ?>
                        <a href="<?php echo "?page=" . ($page - 1) . $orderby; ?>"><===</a>
                    <?php endif; ?>
                </div>
                <div class="col-10 center">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <?php if ($i == $page): ?>
                            <b><a href="<?php echo "?page=$i" . $orderby ?>"><?php echo $i; ?></b>
                        <?php else: ?>
                            <a href="<?php echo "?page=$i" . $orderby ?>"><?php echo $i; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div class="col-1">
                    <?php if ($page < $pages): ?>
                        <a href="<?php echo "?page=" . ($page + 1) . $orderby; ?>">===></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>  
    </main>
</body>
</html>