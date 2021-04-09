<?php include("includes/header.php");?>
<?php include("includes/navigation.php");unset($_SESSION['ref']);$wallet = $db->getWallet($_SESSION['userID']);?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-4">
                <div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Mentorship Expiration</h3>
                        <?php if($user['pmz']>0){?>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number">Active</span><?php }else{?>
                        <span class="number" style="font-size: 12px;line-height:12px;"><?php echo $db->mentorshipExp($user['id']);?></span>
                        <?php }?>
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
            <div class="col-md-4">
            	<div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Affiliate State</h3>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number">Infinity</span>                    
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
            <div class="col-md-4">
            	<div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Affiliate Status</h3>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number">Active</span>                    
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
            <div class="col-md-4">
            	<div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Wallet Balance</h3>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number"><i class="glyphicon glyphicon-usd"></i><?php echo number_format($wallet['balance']);?></span>                    
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
            <div class="col-md-4">
            	<div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Referred By</h3>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number"><?php if($user['ref']==0){echo "Nobody";}else{echo $db->myRef();}?></span>                    
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
            <div class="col-md-4">
            	<div class="wBlock green clearfix">                        
                    <div class="dSpace">
                        <h3>Account Status</h3>
                        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                        <span class="number"><?php echo "Active";?></span>
                    </div>
                    <div class="rSpace">
                    </div>                          
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Today's Educators Roster</h1>
                </div>
                <div class="block-fluid">
                    <div style="padding: 10px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>EDUCATOR</th>
                                    <th>CHANNEL</th>
                                    <th>DAY</th>
                                    <th>TIME</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $educate = $db->getEducatorsToday();
                            foreach((array)$educate as $edu){?>
                                <tr style="border-bottom: 1px solid #CCC;">
                                    <td style="font-weight: bold;"><?php $me = $db->getEducator($edu['educator']);echo $me['lastname']." ".$me['firstname'];?></td>
                                    <td><?php $chan = $db->getChannel($edu['channelID']);echo $chan['channel'];?></td>
                                    <td><?php echo $edu['day'];?></td>
                                    <td><?php echo $edu['time'];?></td>
                                    <td style="text-align: center;"><a href="mint?action=subscribeBrainHub&id=<?php echo $edu['id']?>" onClick="alert('Are you sure?')";>Subscribe</a></td>
                                </div>
                        <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Educators Roster</h1>
                </div>
                <div class="block-fluid">
                    <div style="padding: 10px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>EDUCATOR</th>
                                    <th>CHANNEL</th>
                                    <th>DAY</th>
                                    <th>TIME</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $educate = $db->getEducators();
                            foreach((array)$educate as $edu){?>
                                <tr style="border-bottom: 1px solid #CCC;">
                                    <td style="font-weight: bold;"><?php $me = $db->getEducator($edu['educator']);echo $me['lastname']." ".$me['firstname'];?></td>
                                    <td><?php $chan = $db->getChannel($edu['channelID']);echo $chan['channel'];?></td>
                                    <td><?php echo $edu['day'];?></td>
                                    <td><?php echo $edu['time'];?></td>
                                    <td style="text-align: center;"><a href="mint?action=subscribeBrainHub&id=<?php echo $edu['id']?>" onClick="alert('Are you sure?')";>Subscribe</a></td>
                                </div>
                        <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php");?>