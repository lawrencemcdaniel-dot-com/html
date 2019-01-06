//Opens & Closes Advanced Settings
window.onload=function(){    
    document.getElementById("happyCatshowAdvanced").addEventListener("click", showHappyAdvanced);
    document.getElementById("happyCatshowSimple").addEventListener("click", showHappySimple);

        function showHappyAdvanced(){
            document.getElementById('happyCatAdvancedDiv').classList.remove('happyCatMortCalcHidden');
            document.getElementById('happyCatshowAdvanced').classList.add('happyCatMortCalcHidden');
            }
        function showHappySimple(){
            document.getElementById('happyCatAdvancedDiv').classList.add('happyCatMortCalcHidden');
            document.getElementById('happyCatshowAdvanced').classList.remove('happyCatMortCalcHidden');
            }
    }

jQuery(function ($) {
    //listeners
        $('#happyCalcPriceInput').change(function() {
            calculate();
            calcInsFromHousePrice();
            calcDisplayTaxIns();
            calcPropertyTax();
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcDownInput').change(function() {
            calculate();
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcLoanInput').change(function() {
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcHoa').change(function() {
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcIntRate').change(function() {
            calcInsFromHousePrice();
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcDownPerInput').change(function() {
            calculateP();
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcTax').change(function() {
            calcDisplayTaxIns();
            calcSubTotal();
            calcSuperTotal();
        });
        $('#happyCalcIns').change(function() {
            calcSubTotal();
            calcSuperTotal();
        });

    //start functions off of the listeners
        function calculate(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var downP = $('#happyCalcDownInput').val().replace(/[^\d.]/g, "");
            var perc="";
            if(isNaN(homeP) || isNaN(downP)){
                perc=" ";
                }else{
                perc = ((downP/homeP) * 100).toFixed(1);
                }
                $('#happyCalcDownPerInput').val(perc);
        }
        function calculateP(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var downP = "";
            var perc= $('#happyCalcDownPerInput').val().replace(/[^\d.]/g, "");
            if(isNaN(homeP) || isNaN(downP)){
                downP=" ";
                }else{
                downP = (homeP*(perc/100)).toFixed(2);
                }
                $('#happyCalcDownInput').val(downP);
        }
        function calcPropertyTax(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var propTax = "";
            if(isNaN(homeP)){
                propTax = "";
                }else{
                propTax = (homeP*.006).toFixed(2);
                }
                $('#happyCalcTax').val(propTax);
        }
        /*function calcDisplayIns(){
            var propInsDollar = $('#homeInsuranceId').val().replace(/[^\d.]/g, "");
            var propInsDollarMn = "";
            if(isNaN(propInsDollar)){
                propInsDollarMn=" ";
                }else{
                propInsDollarMn = (propInsDollar/12).toFixed(0);
                }
                $('#homeInsurancePrint').html(propInsDollarMn);
        }*/
        function calcInsFromHousePrice(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var propInsFromHp = "";
            var propInsFromHpMn = "";
            if(isNaN(homeP)){
                propInsFromHp=" ";
                }else{
                propInsFromHp = ((homeP/1000)*3.5).toFixed(2);
                propInsFromHpMn = (((homeP/1000)*3.5)/12).toFixed(0);
                }
                $('#happyCalcIns').val(propInsFromHp);
                $('#homeInsurancePrint').html(propInsFromHpMn);
        }
        function calcDisplayTaxIns(){
            var propTaxDollar = $('#happyCalcTax').val().replace(/[^\d.]/g, "");
            var propTaxDollarMn = "";
            var insDollar = $('#happyCalcIns').val().replace(/[^\d.]/g, "");
            if(isNaN(propTaxDollar)){
                propTaxDollarMn=" ";
                } else{
                propTaxDollarMn = ((propTaxDollar/12)+(insDollar/12)).toFixed(2);
                }
                $('#hcreplaceTax').html(propTaxDollarMn);
        }
        function calcSubTotal(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var downP = $('#happyCalcDownInput').val().replace(/[^\d.]/g, "");
            var interestRate = $('#happyCalcIntRate').val().replace(/[^\d.]/g, "");;
            var loanProgram = $('#happyCalcLoanInput').val();
            var subTotalMonthly = "";
            var mnInterestRate = "";
            var powerShit = "";
            var bigDecimalShit = "";
            if(isNaN(homeP) || isNaN(downP) || isNaN(interestRate) || isNaN(loanProgram)){
                subTotalMonthly=" ";
                }else{
                mnInterestRate = ((interestRate/100)/12);
                powerShit = (Math.pow((1+mnInterestRate), (loanProgram*12)));
                bigDecimalShit = ((mnInterestRate*powerShit)/(powerShit-1));
                subTotalMonthly = ((homeP-downP)*bigDecimalShit).toFixed(0);
                }
                $('#hcreplacePI').html(subTotalMonthly);
        }
        function calcSuperTotal(){
            var homeP = $('#happyCalcPriceInput').val().replace(/[^\d.]/g, "");
            var downP = $('#happyCalcDownInput').val().replace(/[^\d.]/g, "");
            var interestRate = $('#happyCalcIntRate').val();
            var loanProgram = $('#happyCalcLoanInput').val();
            var taxFinal = $('#happyCalcTax').val().replace(/[^\d.]/g, "");
            var insFinal = $('#happyCalcIns').val().replace(/[^\d.]/g, "");;
            var subTotalMonthly = "";
            var mnInterestRate = "";
            var powerShit = "";
            var bigDecimalShit = "";
            var superTotalMonthly = "";
            var superHoaTest = "";
            if(isNaN(homeP) || isNaN(downP) || isNaN(interestRate) || isNaN(loanProgram)){
                subTotalMonthly=" ";
                }else{
                mnInterestRate = ((interestRate/100)/12);
                powerShit = (Math.pow((1+mnInterestRate), (loanProgram*12)));
                bigDecimalShit = ((mnInterestRate*powerShit)/(powerShit-1));
                subTotalMonthly = ((homeP-downP)*bigDecimalShit);
                superTotalMonthly = (subTotalMonthly+(taxFinal/12)+(insFinal/12)).toFixed(0);
                }
                $('#hcreplaceTotal').html(superTotalMonthly);
        }
});