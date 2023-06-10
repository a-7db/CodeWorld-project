<?php require APPROOT . '/views/Admin/dashboard.php' ?>

<style> 
    <?php if (!empty($data['tax_err'])) : ?>.cateInput::-webkit-input-placeholder {
        color: #f00;
    }

    .cateInput {
        border-color: #f00;
    }

    <?php endif; ?>
</style>

<div class="row">
    <div class="col-10 mx-auto">
        <div style="height: 40vh;" class="card mb-4 row">
            <div class="card-header">
                <h6>TAX EDITING</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class="border-bottom">

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 w-50 mx-5 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-usd text-secondary text-lg opacity-10"></i>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 mx-3 text-secondary text-sm">Value Added Tax (VAT)</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-secondary text-lg font-weight-bold">
                        
                        % <?php echo $data['tax']?>
                        
                        </div>
                    </li>
                </div>

                <div class="mx-5 mt-5">
                    <form onsubmit="ll()" action="<?php echo URLROOT ?>/Admins/tax" method="POST" class="row g-3">
                        <div class="col-5">
                            <input type="text" maxlength="3" onkeypress="return onlyNum(event)" class="form-control cateInput" id="Tax" name="Tax" placeholder="<?php echo empty($data['tax_err']) ? 'New Tax' : $data['tax_err'] ?>">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary mb-3 addcate">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function onlyNum(e){
        var x = e.which || e.keycode;
        if(x >= 48 && x <= 57){
            return true;
        } else{
            return false;
        }
    }
</script>

<?php require APPROOT . '/views/Admin/footerDash.php' ?>