    <div class="modal fade" id="exampleModal<?php echo $product['Product']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            
                            <table class="table">
                                <thead>
                                    <th></th> 
                                    <th></th> 
                                    <th>
                                        <?php
                                            if (!empty($product['Product']['name'])) {
                                                echo strtoupper($product['Product']['name']);
                                            }
                                        ?>   
                                    </th> 
                                    <th></th> 
                                </thead> 
                                <tbody> 
                                    <tr> 
                                        <th>Presentacion</th> 
                                        <td></td> 
                                        <td></td> 
                                        <td>                      
                                          <span class="badge">
                                            <?php
                                                if (!empty($product['Product']['presentation'])) {
                                                    echo strtoupper($presentation_types[$product['Product']['presentation']]);
                                                }
                                            ?>
                                          </span>
                                        </td> 
                                    </tr> 
                                    <tr> 
                                        <th>Cantidad de contenido</th> 
                                        <td></td> 
                                        <td></td> 
                                        <td>
                                          <span class="badge">
                                            <?php 
                                                if (!empty($product['Product']['quantity'])) {
                                                    echo strtoupper($product['Product']['quantity']);
                                                }
                                            ?>
                                          </span>
                                        </td> 
                                    </tr> 
                                    <tr> 
                                        <th>Precio costo</th> 
                                        <td></td> 
                                        <td></td> 
                                        <td>
                                          <span class="badge">
                                            <?php
                                                if (!empty($product['Price']['cost_price'])) {
                                                    echo '$ ' . strtoupper($product['Price']['cost_price']);
                                                }
                                            ?>
                                          </span>
                                        </td> 
                                    </tr> 
                                    <tr> 
                                        <th>Porcentaje</th> 
                                        <td></td> 
                                        <td></td> 
                                        <td>
                                            <span class="badge" style="background-color: green">
                                              <?php
                                                if (!empty($product['Price']['percentage_applied'])) {
                                                    echo strtoupper($percentages[$product['Price']['percentage_applied']]);
                                                }
                                              ?>
                                            </span>
                                        </td> 
                                    </tr> 
                                    <?php if (!empty(strtoupper($product['Price']['price_per_grams']))) :?>
                                    <tr>
                                        <th>Precio 100 grs</th> 
                                        <td></td> 
                                        <td></td> 
                                        <td>
                                            <span class="badge">
                                              <?php echo '$ ' . strtoupper($product['Price']['price_per_grams']);?>
                                            </span>
                                        </td> 
                                    </tr>
                                    <?php endif;?>
                                    <tr> 
                                        <th>Precio venta</th> 
                                        <td></td>
                                        <td></td> 
                                        <td>
                                            <span class="badge" style="background-color: red">
                                            <?php
                                                if (!empty($product['Price']['sale_price'])) {
                                                    echo '$ ' . strtoupper($product['Price']['sale_price']);
                                                }
                                            ?>
                                            </span>
                                        </td> 
                                    </tr> 
                                </tbody> 
                            </table>

            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
      </div>
      </div>
    </div>