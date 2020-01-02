<?php

include ("dbConnection.php");
session_start();

 	$userid = $_SESSION["userId"];

 	$arrayHistory = array();
 	$i=0;
                                $sql = "SELECT transaction_type,transaction_id FROM transactions where userid='$userid' order by transaction_id desc";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                               
                                 
                                  foreach ($row1 = $result->fetch_assoc()) {
                                  
                                    
                                  
                                   if($row1["transaction_type"]=="BILL")
                                   {
                                        $tempCat = "Bill Payment";
                                        $temporary = $row1["transaction_id"];
                                         $sql = "SELECT bill_payment.payment_date,bill_payment.amount,bill_type.bill_name,bill_payment.transaction_id FROM bill_payment,bill_type where bill_payment.billtypeid=bill_type.bill_type_id 
                                         and bill_payment.transaction_id = '$temporary' ";
                                         $result = $conn->query($sql);
                                          if ($result->num_rows > 0) {
                                          // output data of each row
                                            $row = $result->fetch_assoc();
                                            $arrayHistory[$i] = "<div class='form-group input-group'>
                                             <span class='input-group-addon'><i class='fa fa-history'  ></i></span>
                                             <p type='text' class='form-control'  > ". 
                                                 $tempCat
                                             . " on ".$row["payment_date"]."  of  ".$row["amount"]." Rs.  (".$row["bill_name"].")</p>
                                              </div>";
                                          }
                                          $i++;
                                   }
                                   else if($row1["transaction_type"]=="MONEYT")
                                   {
                                        $tempCat = "Money Transfer";
                                        $temporary = $row1["transaction_id"];
                                         $sql = "SELECT contact_info.email,money_transfer.transfer_date,money_transfer.amount FROM money_transfer,contact_info where money_transfer.recieverid=contact_info.user_id 
                                         and money_transfer.transaction_id = '$temporary' ";
                                         $result = $conn->query($sql);
                                          if ($result->num_rows > 0) {
                                          // output data of each row
                                            $row = $result->fetch_assoc();
                                            $arrayHistory[$i]= "<div class='form-group input-group'>
                                             <span class='input-group-addon'><i class='fa fa-history'  ></i></span>
                                             <p type='text' class='form-control'  > ". 
                                                 $tempCat
                                             . " to ".$row["email"]."  of  ".$row["amount"]." Rs.  on ".$row["transfer_date"]."</p>
                                              </div>";
                                          }
                                          $i++;
                                   }
                                 }        
                               
                             }
                               else
                                echo "No History....";
                             
                            


                            for($i=0;$i<10;$i++)    
                            {
                            	echo $arrayHistory[$i];
                            }

?>