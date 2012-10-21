<style>
	div#main {
		color: #5f6b79;
		font-size: 14px;
	}

	.contact_main {
		line-height: 20px;
		list-style: none;
		margin-left: 0;
		margin-top: 20px;
		margin-bottom: 15px;
	}

	.contact_main li {
		height: 50px;
		padding-top: 15px;
		padding-bottom: 10px;
		border-bottom: 1px dashed #afb7bf;
		padding-left: 60px;
		font-size: 13px;
		color: #666e73;
		background: url(<?php echo Asset::get_file( 'contact-icons.png', 'img' ) ?>) no-repeat;
	}

	#gmap {
		background: white;
		width: 476px;
		height: 269px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-ms-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
		border-right: 1px solid #c2cbd2;
		border-bottom: 1px solid #c2cbd2;
		padding: 6px;
		margin-top: 5px;
		margin: auto;
	}

	#gmap small { display: none; }

	label {
		display: block;
		color: #666e73;
		font-size: 13px;
		margin-bottom: 5px;
	}

	label span {
		color: #e75b5b;
	}

	input { width: 250px; }
	
	textarea { width: 300px; height: 120px; }
</style>

<div class="title_bg">
    <h2 class="title">Contact</h2>
</div>

<div class="span3" style="margin-left: 0;">
	<p>
		IUT de Vannes,<br>
		12 Rue Montaigne<br>
		56000,<br>
		Vannes
	</p>
	<ul class="contact_main">
		<li style="background-position: 0 -140px;">
			+387 123 456, +387 123 456<br>
			+387 123 456
		</li>
		<li style="background-position: 0 -65px;">
			+387-123-456-1<br>
			+387-123-456-2
		</li>
		<li style="background-position: 0 12px;">
			your@email.com<br>
			customer.case@mail.com
		</li>
	</ul>
</div>

<div class="span9">
	<div id="gmap">
		<iframe width="476" height="269" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
		src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=iut+de+vannes&amp;aq=&amp;
		sll=49.439557,-162.333984&amp;sspn=44.035989,79.013672&amp;t=h&amp;ie=UTF8&amp;hq=iut&amp;hnear=Vannes,+Morbihan,+Bretagne,
		+France&amp;ll=47.651195,-2.771173&amp;spn=0.007777,0.020385&amp;z=15&amp;output=embed"></iframe>
		<br />
		<small>
		<a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=iut+de+vannes&amp;aq=&amp;
		sll=49.439557,-162.333984&amp;sspn=44.035989,79.013672&amp;t=h&amp;ie=UTF8&amp;hq=iut&amp;hnear=Vannes,+Morbihan,+Bretagne,+France
		&amp;ll=47.651195,-2.771173&amp;spn=0.007777,0.020385&amp;z=15" style="color:#0000FF;text-align:left">
			Agrandir le plan
		</a>
		</small>
	</div>
</div>

<div class="clearfix"></div>

<div class="title_bg">
    <h2 class="title">Quick Contact</h2>
</div>

<?php echo Form::open() ?>
	<p>
		<label for="name">Name<span>*</label>
		<input type="text" name="name" id="name" placeholder="ex: John" value="<?php echo $val->validated( 'name' ) ?>">
	</p>
	<?php $val->error( 'name' ) ? '<p class="form_error">' . $val->error( 'name' ) . '</p>' : '' ?>
	<p>
		<label for="email">Email<span>*</label>
		<input type="text" name="email" id="email" placeholder="ex: Doe" value="<?php echo $val->validated( 'email' ) ?>">
	</p>
	<?php $val->error( 'email' ) ? '<p class="form_error">' . $val->error( 'email' ) . '</p>' : '' ?>
	<p>
		<label for="message">Message<span>*</label>
		<textarea name="message" id="message" placeholder="ex: Enter you message here"><?php echo $val->validated( 'message' ) ?></textarea>
	</p>
	<?php $val->error( 'message' ) ? '<p class="form_error">' . $val->error( 'message' ) . '</p>' : '' ?>
	<p>
		<button class="btn btn-primary" type="submit">Submit</button>
	</p>
</form>