<?php include('include/header.php') ?>
<?php
// Initialize variables
$emiResult = null;
$loanTenure = 0;
$loanAmount = 0;
$interestRate = 0;
$processingFee = 0;
$totalInterest = 0;
$totalPayment = 0;
$progressPercent = 0;
$processingFeePercent = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loanAmount = $_POST['loan_amount'] * 100000; 
    $interestRate = $_POST['interest_rate'];
    $loanTenure = $_POST['loan_tenure'];

    $monthlyInterestRate = $interestRate / (12 * 100);
    $numberOfMonths = $loanTenure * 12;

    $emi = ($loanAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $numberOfMonths)) /
           (pow(1 + $monthlyInterestRate, $numberOfMonths) - 1);

    $emiResult = round($emi); 

    $totalPayment = $emiResult * $numberOfMonths;
    $totalInterest = $totalPayment - $loanAmount;

    $processingFee = round(($processingFeePercent / 100) * $loanAmount);

    $progressPercent = min(100, ($loanTenure / 30) * 100);
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<div class="container my-4">
  <h4 class="mb-4 text-center">🏠 EMI Calculator</h4>
  <form method="POST" class="card p-5 shadow-lg mx-auto" style="max-width: 600px;">
    
    <!-- Loan Amount Range -->
    <div class="mb-4">
      <label for="loan_amount" class="form-label fs-5">Loan Amount (₹): <strong><span id="loanAmountValue"><?php echo $loanAmount ? $loanAmount / 100000 : 14; ?></span>L</strong></label>
      <input type="range" class="form-range" min="1" max="100" name="loan_amount" id="loan_amount" value="<?php echo $loanAmount ? $loanAmount / 100000 : 14; ?>" oninput="loanAmountValue.innerText = this.value">
    </div>

    <!-- Interest Rate Range -->
    <div class="mb-4">
      <label for="interest_rate" class="form-label fs-5">Annual Interest Rate (%): <strong><span id="interestRateValue"><?php echo $interestRate ?: 8; ?></span>%</strong></label>
      <input type="range" class="form-range" min="7" max="15" step="0.1" name="interest_rate" id="interest_rate" value="<?php echo $interestRate ?: 8; ?>" oninput="interestRateValue.innerText = this.value">
    </div>

    <!-- Loan Tenure Range -->
    <div class="mb-4">
      <label for="loan_tenure" class="form-label fs-5">Loan Tenure (Years): <strong><span id="tenureValue"><?php echo $loanTenure ?: 14; ?></span> Years</strong></label>
      <input type="range" class="form-range" min="2" max="30" name="loan_tenure" id="loan_tenure" value="<?php echo $loanTenure ?: 14; ?>" oninput="tenureValue.innerText = this.value">
    </div>

    <button type="submit" class="btn btn-dark w-100">Calculate EMI</button>

    <?php if ($emiResult !== null): ?>
      <!-- EMI Calculation Result -->
      <div class="card shadow mt-4 border-0">
        <div class="card-body text-center">
          <h5 class="card-title mb-4 text-primary">📊 EMI Calculation Summary</h5>
          
          <!-- EMI Summary -->
          <div class="row justify-content-center mb-2">
            <div class="col-md-12 text-start">
              <h6 class="p-2 bg-light mb-2"><i class="bi bi-currency-rupee" style="color: #183b4a; padding: 3px; background-color: #c8e7fc; border: 1px solid gray; border-radius: 5px;"></i>
              <strong>Loan Amount:</strong> ₹<?php echo number_format($loanAmount); ?></h6>
              <h6 class="p-2 bg-light mb-2"><i class="bi bi-calendar2-week" style="color: #183b4a; padding: 3px; background-color: #c8e7fc; border: 1px solid gray; border-radius: 5px;"></i> <strong>Monthly EMI:</strong> ₹<?php echo number_format($emiResult); ?></h6>
              <h6 class="p-2 bg-light mb-2"><i class="bi bi-piggy-bank" style="color: #183b4a; padding: 3px; background-color: #c8e7fc; border: 1px solid gray; border-radius: 5px;"></i> <strong>Total Interest Payable:</strong> ₹<?php echo number_format($totalInterest); ?></h6>
              <h6 class="p-2 bg-light mb-2"><i class="bi bi-cash-stack" style="color: #183b4a; padding: 3px; background-color: #c8e7fc; border: 1px solid gray; border-radius: 5px;"></i> <strong>Total Payment (Principal + Interest):</strong> ₹<?php echo number_format($totalPayment); ?></h6>
              
            </div>
          </div>
        </div>
      </div>

      <!-- Loan Tenure Progress -->
    
    <?php endif; ?>

  </form>
</div>

<?php include('include/footer.php') ?>
