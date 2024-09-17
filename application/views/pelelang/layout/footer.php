			</div>
    	</div>
		<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/daterangepicker.js"></script>
		<script src="<?php echo base_url() ?>assets/js/stisla.js"></script>
		<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
		<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/ckeditor.js"></script>
		<script src="<?php echo base_url() ?>assets/js/moment-with-locales.js"></script>
		<script src="<?php echo base_url() ?>assets/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/cleave.min.js"></script>

		<script>
			$('.number-cleave').toArray().forEach(function(field){
				new Cleave(field, {
					numeral: true,
					numeralThousandsGroupStyle: 'thousand',
					numeralDecimalMark: ',',
					delimiter: '.'
				});
			});
		</script>
	</body>
</html>
