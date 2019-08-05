<table class="table table-hover dt-pag-btrp">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Article Prix</th>
                                <th>Article Taux Remise</th>
                                <th>Article Prix Remise</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            $article = new Article();
                            $query = $article->AfficherArticles();
                            if($query != null):

                                while($row = $query->fetch_assoc()){
                                    $articleImage = $article->ImageArticle($row['articleID']);

                                    echo '<tr>';
                                    echo '<td data-id="'.$row['articleID'].'">'.$row['articleID'].'</td>';
                                    echo '<td><img class="img-responsive" src="'.$articleImage.'"></td>';
                                    echo '<td data-id="'.$row['articleNom'].'">'.$row['articleNom'].'</td>';
                                    echo '<td data-id="'.$row['articleDescription'].'">'.$row['articleDescription'].'</td>';
                                    echo '</tr>';
                                }


                            endif;
                        ?>
                        </tbody>
                     </table>