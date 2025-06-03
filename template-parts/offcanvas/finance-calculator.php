<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFinanceCalculator"
  aria-labelledby="offcanvasFinanceCalculatorLabel">
  <div class="offcanvas-body">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body--inner background-white rounded overflow-hidden">
      <div class="offcanvas-form--holder">
        <div class="offcanvas-form--form">
          <div class="offcanvas-form--form-header background-yellow p-20">
            <div class="row g-4 justify-content-between align-items-center g-3">
              <div class="col-lg-6">
                <h4 class="fs-32">Finance calculator</h4>
              </div>
              <div class="col-lg-6">
                <p>
                  7.9% available, calculate the cost of your caravan or motorhome
                </p>
              </div>
            </div>
          </div>
          <div class="offcanvas-form--form-fields">
            <form action="" class="offcanvas-form mb-20">
              <div class="row g-3">
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'  => 'text',
                    'name'  => 'Deposit',
                    'id'    => 'Deposit',
                    'label' => 'Deposit:',
                    'class' => 'form-control-lg',
                    'value' => '£100'
                  ));
                  ?>
                </div>
                <div class="col-lg-6">
                  <?php
                  echo form_control(array(
                    'type'    => 'select',
                    'name'    => 'Duration',
                    'id'      => 'Duration',
                    'label'   => 'Duration:',
                    'class'   => 'form-control-lg',
                    'options' => array(
                      ''         => 'Select Duration',
                      'Option 1' => 'Option 1',
                      'Option 2' => 'Option 3',
                      'Option 3' => 'Option 3',
                    ),
                  ));
                  ?>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-lg btn-blue w-100"> Calculate </button>
                </div>
              </div>
            </form>

            <div class="desc fs-12 mb-20">
              <p> Change the deposit and repayment period and the calculator will automatically work out your estimated
                repayments. The APR offered may vary according to a number of factors including deposit paid, status of
                the applicant, fees and charges and frequency of payments. *Final payment includes £10 Option To
                Purchase
                Fee</p>
            </div>
            <div class="offcanvas-form--results fs-16">
              <div class="row g-3">
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Cash_Price',
                    'id'        => 'Cash_Price',
                    'label'     => 'Cash Price:',
                    'attribute' => 'readonly',
                    'value'     => '£8,488'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'deposit',
                    'id'        => 'deposit',
                    'label'     => 'Deposit:',
                    'attribute' => 'readonly',
                    'value'     => '£100'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Total_Amount_of_Credit',
                    'id'        => 'Total_Amount_of_Credit',
                    'label'     => 'Total Amount of Credit:',
                    'attribute' => 'readonly',
                    'value'     => '£8,488'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Agreement_Duration',
                    'id'        => 'Agreement_Duration',
                    'label'     => 'Agreement Duration:',
                    'attribute' => 'readonly',
                    'value'     => '7 Years'
                  ));
                  ?>
                </div>

                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Monthly_Repayments_of',
                    'id'        => 'Monthly_Repayments_of',
                    'label'     => '84 Monthly Repayments of:',
                    'attribute' => 'readonly',
                    'value'     => '£140.95'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Total_Amount_Repayable',
                    'id'        => 'Total_Amount_Repayable',
                    'label'     => 'Total Amount Repayable:',
                    'attribute' => 'readonly',
                    'value'     => '£11,939.80'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Purchase_Fee',
                    'id'        => 'Purchase_Fee',
                    'label'     => 'Purchase Fee*:',
                    'attribute' => 'readonly',
                    'value'     => '£10'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Interest_Rate',
                    'id'        => 'Interest_Rate',
                    'label'     => 'Interest Rate:',
                    'attribute' => 'readonly',
                    'value'     => '10.37%'
                  ));
                  ?>
                </div>
                <div class="col-lg-4">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Representative_APR',
                    'id'        => 'Representative_APR',
                    'label'     => 'Representative APR:',
                    'attribute' => 'readonly',
                    'value'     => '10.9%'
                  ));
                  ?>
                </div>
                <div class="col-12">
                  <?php
                  echo form_control(array(
                    'type'      => 'text',
                    'name'      => 'Monthly_payment',
                    'id'        => 'Monthly_payment',
                    'label'     => false,
                    'attribute' => 'readonly',
                    'value'     => 'Monthly payment: £140.95',
                    'class'     => 'form-control-lg text-center border fs-20 fw-semibold'
                  ));
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>