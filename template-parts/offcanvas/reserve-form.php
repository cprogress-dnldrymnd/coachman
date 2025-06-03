<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasReserveForm"
  aria-labelledby="offcanvasReserveFormLabel">
  <div class="offcanvas-body">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body--inner background-white rounded overflow-hidden">
      <div class="offcanvas-form--holder">
        <div class="offcanvas-form--form">
          <div class="offcanvas-form--form-header background-gray p-20">
            <h4 class="fs-32">Reserve this caravan for free</h4>
          </div>

          <div class="offcanvas-form--form-fields">
            <form action="" class="offcanvas-form mb-20">
              <div class="row g-3">
                <div class="col-lg-12">
                  <div class="desc">
                    <p> Fill in the form below to reserve the <span class="name"><strong>Elddis Avante 462
                          2012</strong></span>
                      and a member of the team will be in
                      contact with you to arrange a viewing.</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'First_Name',
                    'id'    => 'First_Name',
                    'label' => 'First Name:',
                    'class' => 'form-control',
                    'value' => 'John'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Last_Name',
                    'id'    => 'Last_Name',
                    'label' => 'Last Name:',
                    'class' => 'form-control',
                    'value' => 'Doe'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'email',
                    'name'  => 'Email',
                    'id'    => 'Email',
                    'label' => 'Email:',
                    'class' => 'form-control',
                    'value' => 'johndoe@gmail.com'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Address_1',
                    'id'    => 'Address_1',
                    'label' => 'Address 1:',
                    'class' => 'form-control',
                    'value' => 'Address line 1'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Address_2',
                    'id'    => 'Address_2',
                    'label' => 'Address 2:',
                    'class' => 'form-control',
                    'value' => 'Address line 2'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'City',
                    'id'    => 'City',
                    'label' => 'City:',
                    'class' => 'form-control',
                    'value' => 'Chester'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Postcode',
                    'id'    => 'Postcode',
                    'label' => 'Postcode:',
                    'class' => 'form-control',
                    'value' => 'CH5 3TY'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Phone_Number',
                    'id'    => 'Phone_Number',
                    'label' => 'Phone Number:',
                    'class' => 'form-control',
                    'value' => '+44 77556 4818'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'date',
                    'name'  => 'Date_of_Planned_Visit',
                    'id'    => 'Date_of_Planned_Visit:',
                    'label' => 'Date of Planned Visit:',
                    'class' => 'form-control',
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'date',
                    'name'  => 'Time_of_Planned_Visit',
                    'id'    => 'Time_of_Planned_Visit:',
                    'label' => 'Time of Planned Visit:',
                    'class' => 'form-control',
                  ));
                  ?>
                </div>
                <div class="col-lg-12">
                  <?php
                  echo form_control(array(
                    'type'  => 'textarea',
                    'name'  => 'Additional_Comments',
                    'id'    => 'Additional_Comments',
                    'label' => 'Additional Comments:',
                    'class' => 'form-control',
                  ));
                  ?>
                </div>
                <div class="desc">
                  <p>
                    Almost done... we will reserve the caravan for 5 days; a member of our sales team will be in touch
                    with you shortly to confirm your viewing.
                  </p>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-lg btn-primary w-100"> Calculate </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>