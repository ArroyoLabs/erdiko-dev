<div class="container">
      <div class="page-header" id="banner">
      <div class="row">
      	<div class="col-lg-12 col-md-12">
      		<h1>2 Column Layout</h1>
      	</div>
      </div>
    <div class="row">
        <div class="col-lg-6 col-md-6" id="column-left"><?php echo $this->getRegion('one') ?></div>
        <div class="col-lg-6 col-md-6" id="column-right"><?php echo $this->getData()['two'] ?></div>
    </div>
    </div>
</div>