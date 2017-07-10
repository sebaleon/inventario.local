    <div class="modal fade" id="exampleModal<?php echo $product['Product']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <h4 style="text-align: center">
                <?php
                    if (!empty($product['Product']['name'])) {
                        echo strtoupper($product['Product']['name']);
                    }
                ?>                    
              </h4>
                            <table class="table table-striped table-bordered" cellspacing="0">
                                <tbody> 
                                    <tr> 
                                        <th>Presentacion</th> 
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
                                        <td>
                                            <span class="badge">
                                              <?php echo '$ ' . strtoupper($product['Price']['price_per_grams']);?>
                                            </span>
                                        </td> 
                                    </tr>
                                    <?php endif;?>
                                    <tr> 
                                        <th>Precio venta</th> 
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
                                    <tr> 
                                        <th>Última modificación</th> 
                                        <td>
                                            <span class="badge">
                                            <?php
                                                if (!empty($product['Product']['modified'])
													and ($product['Product']['modified'] != $product['Product']['created'])) {
                                                    echo $this->Time->format($product['Product']['modified'], '%d/%m/%Y %H:%M:%S');
                                                } else {
													echo "No se ha modicado";
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