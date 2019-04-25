<?php require 'app/model/student-funct.php'; $run = new studentFunct ?>

<div class="contentpage">
    <div class="row">
        <div class="eventwidget">
            <div class="contleft">
                <div class="header">
                    <p> 
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Statement of Accounts</span>
                    </p>
                </div>
                <div class="cont" id="soa">      
                    <div class="conthead">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Balance: &nbsp;  &#8369; <?php $run->getBalance(); ?></p>

                    </div>
                    <div class="head" id="soahead">
                        <p id="header"> 
                            <span>History of Payment</span></p>
                            <p class="align-right" id="header"><span>School Year: <select name="year" id="filter-year">
                                <?php 
                                if (!isset($_SESSION['year'])) $_SESSION['year'] = date('Y');
                                foreach ($run->getPayYear() as $row) {
                                    extract($row);
                                    echo '<option value='.$year.' '.($year === $_SESSION['year'] ? 'selected' : '').'>'.$year.'</option>';
                                }
                                ?>
                            </select>  
                        </p>
                        <div id="filter-year-stud">
                            <?php $year = !isset($_SESSION['year']) ? date('Y') : $_SESSION['year']; ?>
                            <table id="student-payment-history" class="display">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="align-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $run->getPaymentHisto($year) ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contright">
                <div class="widget">
                    <div class="header">
                        <p><i class="fas fa-file fnt"></i><span> Breakdown</span></p>
                    </div>
                    <div class="widgetcontent">
                        <table id = "breakdown">
                            <tr>
                                <th>Description</th>
                                <th class="align-right">Amount</th>
                            </tr>
                            <?php $run->getBreakdown();?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['year'])) unset($_SESSION['year']); ?>