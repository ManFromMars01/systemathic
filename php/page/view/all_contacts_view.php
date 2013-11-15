<div id="content" class="span10">
            <!-- content starts -->


            <?php breadcrumb('Contacts / All Contacts');?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> All Contacts <?php echo ucfirst($_GET['query']); ?> </h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                          <tbody>
                                <?php if($_GET['query'] == 'parent'):?>    


                                <?php foreach($tcustomer as $tcustomers): ?>
                                <tr>
                                    <td><?php echo $tcustomers['Mother']; ?></td>
                                    <td><?php echo $tcustomers['MMobile']; ?></td>
                                    <td><?php echo $tcustomers['MEmail'];?></td>
                                    <td><?php echo $tcustomers['Address'];?>, <?php echo $tcustomers['City'];?></td>
                                    <td>
                                        <a class="btn btn-success hidden-desktop" href="<?php echo $tcustomers['MMobile']; ?>">Mobile Call</a>
                                        <a class="btn btn-success hidden-phone" href="skype:<?php echo $tcustomers['MMobile']; ?>?call">Skype Call</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php elseif($_GET['query'] == 'vendor'): ?>

                                <?php foreach($vendor as $vendors): ?>
                                <tr>
                                    <td><?php echo $vendors['Name']; ?></td>
                                    <td><?php echo $vendors['Phone']; ?></td>
                                    <td><?php echo $vendors['Email'];?></td>
                                    <td><?php echo $vendors['Address1'];?>, <?php echo $vendors['City'];?></td>
                                    <td>
                                        <a class="btn btn-success hidden-desktop" href="<?php echo $vendors['Phone']; ?>">Mobile Call</a>
                                        <a class="btn btn-success hidden-phone" href="skype:<?php echo $vendors['Phone']; ?>?call">Skype Call</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                <?php elseif($_GET['query'] == "manufacturer"):  ?>
                                <?php foreach($manufacturer as $manufacturers): ?>
                                <tr>
                                    <td><?php echo $manufacturers['Description']; ?></td>
                                    <td><?php echo $manufacturers['Phone']; ?></td>
                                    <td><?php echo $manufacturers['Email'];?></td>
                                    <td><?php echo $manufacturers['Address'];?>, <?php echo $vendors['City'];?></td>
                                    <td>
                                        <a class="btn btn-success hidden-desktop" href="<?php echo $manufacturers['Phone']; ?>">Mobile Call</a>
                                        <a class="btn btn-success hidden-phone" href="skype:<?php echo $manufacturers['Phone']; ?>?call">Skype Call</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php elseif($_GET['query'] == "branch"):  ?>
                                <?php foreach($franchise as $franchises): ?>
                                <tr>
                                    <td><?php echo $franchises['Description']; ?></td>
                                    <td><?php echo $franchises['Phone']; ?></td>
                                    <td><?php echo $franchises['Email'];?></td>
                                    <td><?php echo $franchises['Address'];?></td>
                                    <td>
                                        <a class="btn btn-success hidden-desktop" href="<?php echo $franchises['Phone']; ?>">Mobile Call</a>
                                        <a class="btn btn-success hidden-phone" href="skype:<?php echo $franchises['Phone']; ?>?call">Skype Call</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>


                                <?php endif; ?>      
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->

             