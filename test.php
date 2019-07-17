<div id=''.$row['articleID'].'' class='product-widget pw-panier'>
                        <div class='product-img'>
                            <img src=''.$imageArticle.'' alt=''>
                        </div>
                        <div class='product-body' style='text-align:left'>
                            <h3 class='product-name'><a href='#'>'.$row['articleNom'].'</a></h3>
                            <h4 class='product-price'><span class='qty'>'.$row['NbrArticlesPanier'].'x</span>'.$prix.'</h4>
                        </div>
                        <button id=''.$row['articleID'].'' class='delete supp-panier'><i class='fa fa-close'></i></button>
                    </div>


return json_encode(array('prixTotal' => 0, 'data' => 'Votre panier est vide. Aller faire les courses!', 'qty-panier' => 0));