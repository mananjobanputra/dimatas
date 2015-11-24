<!-- search panel code -->
<div class="search-panel">
    <form class="form-inline validate_form" role="form" id="" name="" method="get" action="<?php echo base_url()."explore/?"; ?>">
        <div class="form-group">
        <input type="text" class="form-control" id="city" name="address" placeholder="Address" data-rule-required="true">
        </div>
        <div class="form-group hidden-xs adv">
            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                <span class="dropdown-label">Bedrooms</span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-select">
                <?php for($i=1;$i<=10;$i++){ ?>
                <li>
                    <input type="radio" name="bedroom">
                    <a href="Javascript:void(0)"><?php echo $i; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="form-group hidden-xs adv">
            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                <span class="dropdown-label">Bathrooms</span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-select">
                <?php for($i=1;$i<=10;$i++){ ?>
                <li>
                    <input type="radio" name="bathroom">
                    <a href="Javascript:void(0)"><?php echo $i; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="form-group hidden-xs adv">
            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input class="form-control price" type="text" placeholder="From" name="price_lower_bound" data-rule-digits="true">
            </div>
        </div>
        <div class="form-group hidden-xs adv">
            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input class="form-control price" type="text" placeholder="To" name="price_upper_bound" data-rule-digits="true">
            </div>
        </div>
        <div class="form-group hidden-xs adv">
            <div class="checkbox custom-checkbox">
                <label>
                    <input type="checkbox" name="pType" value="r" class="homesearch">
                    <span class="fa fa-check"></span> For Rent</label>
                </div>
            </div>
            <div class="form-group hidden-xs adv">
                <div class="checkbox custom-checkbox">
                    <label>
                        <input type="checkbox" name="pType" value="s" class="homesearch">
                        <span class="fa fa-check"></span> For Sale
                    </label>
                </div>
            </div>
            <div class="form-group">

               <button type="submit" class="btn btn-green">Search</button>
               <a href="javascript:void(0);" class="btn btn-o btn-white pull-right visible-xs" id="advanced">Advanced Search <span class="fa fa-angle-up"></span></a>
           </div>
       </form>
   </div>
<!-- end of search panel -->