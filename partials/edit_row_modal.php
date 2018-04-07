<!-- edit row Modal -->
<div class="modal fade editRow" id="editRow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Edit row
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
						
			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="firstnameinput">First Name</label>
						<input type="text" name="firstname" class="form-control" id="firstnameinput" placeholder="enter first name" value="<?= $_GET['first_name__c']; ?>"/>
						<div class="invalid-feedback">
        				  Please provide a first name.
        				</div>
					</div>
					<div class="form-group">
						<label for="lastnameinput">Last Name</label>
						<input type="text" name="lastname" class="form-control" id="lastnameinput" placeholder="enter last name" value="<?= $_GET['last_name__c']; ?>"/>
						<div class="invalid-feedback">
        				   Please provide a last name.
        				</div>
					</div>
					<div class="form-group">
						<label for="emailinput">Email</label>
						<input type="email" name="email" class="form-control" id="emailinput" placeholder="enter email" value="<?= $_GET['email__c']; ?>"/>
						<div class="invalid-feedback">
        				  Please provide a propper email
        				</div>
					</div>
					<div class="form-group">
						<label for="countryinput">Country</label>
						<select name="country" class="dropdown_countries form-control" id="countryinput" placeholder="enter country" value="<?= $_GET['country__c']; ?>">
						</select>
						<div class="invalid-feedback">
        				  Please provide a country.
        				</div>
					</div>
					<div class="form-group">
						<label for="positioninput">Position</label>
						<input name="position" type="text" class="form-control" id="positioninput" placeholder="enter position"  value="<?= $_GET['position__c']; ?>"/>
						<div class="invalid-feedback">
        				  Please provide a position.
        				</div>
					</div>
					<input type="hidden" name="attendeetype" class="form-control" id="attendeetypeinput" value="<?= $_GET['attendeetype']; ?>"/>
					<input type="hidden" name="sql_id" class="form-control" id="sql_id" value="<?= $_GET['sql_id']; ?>"/>
				</form>	
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary save">Save</button>
			</div>
		</div>
	</div>
</div>
