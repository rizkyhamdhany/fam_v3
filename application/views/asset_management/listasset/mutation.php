<?php
$BranchID = $this->session->userdata('BranchID');
$ZoneName = $this->session->userdata('ZoneName');
$BranchName = $this->session->userdata('BranchName');
$ZoneID = $this->session->userdata('ZoneID');
?>
<br>
<div class="form-group">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="class" value="<?php echo $type->ClassCode; ?>">
    <input type="hidden" name="type" value="<?php echo $type->TypeCode; ?>">
    <input type="hidden" name="faid" value="<?php echo trim($faid); ?>">
    <label class="control-label col-sm-3">Zone</label>
    <div class="col-sm-7">
        <?php
        if ($BranchID <> 1) {
            ?>
            <select class="form-control required" name="zona" id="zona" required>
                <option value="<?php echo $ZoneID; ?>"><?php echo $ZoneName; ?></option>
            </select>
        <?php } else { ?>
            <select class="form-control required" name="zona" id="zona" required>
                <option value="">--Select--</option>   
                <?php foreach ($zona as $row) { ?>
                    <option value="<?php echo $row->ZoneID; ?>"><?php echo $row->ZoneName; ?></option>
                <?php } ?>             
            </select>                
        <?php } ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3">Branch</label>
    <div class="col-sm-7">
        <?php
        if ($BranchID <> 1) {
            ?>
            <select class="form-control" name="cabang" id="cabang" class="required" required>
                <option value="<?php echo $BranchID; ?>"><?php echo $BranchName; ?></option>                           
            </select>
        <?php } else { ?>
            <select class="form-control" name="cabang" id="cabang" class="required" required>
                <option value="">--Select--</option>                           
            </select>
        <?php } ?>
    </div>
</div>
<div class="form-group" style="display: none" id="displaydivisi">
    <label class="control-label col-sm-3">Division</label>
    <div class="col-sm-7">
        <select class="form-control divisi" name="divisi" id="divisi" class="required" required>
            <option value="">--Select--</option>                
        </select>
    </div>
</div>

<?php
if ($BranchID <> 1) {
    ?>
    <div class="form-group" id="displayUnit">
        <label class="control-label col-sm-3">Unit</label>
        <div class="col-sm-7">
            <select class="form-control unit" name="unit" id="unit">
                <option value="">--Select--</option>   
                <?php foreach ($dataUnit as $row) { ?>
                    <option value="<?php echo $row->BisUnitID; ?>"><?php echo $row->BisUnitName; ?></option>
                <?php } ?>               
            </select>
        </div>
    </div>
<?php } else { ?>
    <div class="form-group" style="display: none" id="displayUnit">
    <label class="control-label col-sm-3">Unit</label>
    <div class="col-sm-7">
            <select class="form-control unit" name="unit" id="unit">
                <option value="">--Select--</option>                
            </select>
        </div>
    </div>
<?php } ?>
