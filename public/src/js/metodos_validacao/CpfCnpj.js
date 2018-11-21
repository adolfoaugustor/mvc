function validarCnpj(value){

    cnpj = value.replace(/\D/g,"");
    while(cnpj.length < 14) cnpj = "0"+ cnpj;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];

    for (i=0; i<12; i++){
        a[i] = cnpj.charAt(i);
        b += a[i] * c[i+1];
    }

    if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
    b = 0;
    for (y=0; y<13; y++) {
        b += (a[y] * c[y]);
    }

    if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
    if ((cnpj.charAt(12) != a[12]) || (cnpj.charAt(13) != a[13]) || cnpj.match(expReg) ) return false;
    return true;
}

function validarCpf(value){

    // Removing special characters from value
    value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "" );

    // Checking value to have 11 digits only
    if ( value.length !== 11 ) {
        return false;
    }

    var sum = 0,
        firstCN, secondCN, checkResult, i;

    firstCN = parseInt( value.substring( 9, 10 ), 10 );
    secondCN = parseInt( value.substring( 10, 11 ), 10 );

    checkResult = function( sum, cn ) {
        var result = ( sum * 10 ) % 11;
        if ( ( result === 10 ) || ( result === 11 ) ) {
            result = 0;
        }
        return ( result === cn );
    };

    // Checking for dump data
    if ( value === "" ||
        value === "00000000000" ||
        value === "11111111111" ||
        value === "22222222222" ||
        value === "33333333333" ||
        value === "44444444444" ||
        value === "55555555555" ||
        value === "66666666666" ||
        value === "77777777777" ||
        value === "88888888888" ||
        value === "99999999999" ||
        value === "98765432100"
    ) {
        return false;
    }

    // Step 1 - using first Check Number:
    for ( i = 1; i <= 9; i++ ) {
        sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 11 - i );
    }

    // If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
    if ( checkResult( sum, firstCN ) ) {
        sum = 0;
        for ( i = 1; i <= 10; i++ ) {
            sum = sum + parseInt( value.substring( i - 1, i ), 10 ) * ( 12 - i );
        }
        return checkResult( sum, secondCN );
    }
    return false;

}

jQuery.validator.addMethod("validarCpfCnpj",function(value,element){

   return validarCpfCnpj(value);

}, "Por favor especifique um CPF ou CNPJ válido");

jQuery.validator.addMethod("Cnpj", function(value, element) {

    return validarCnpj(value);

}, "Por favor especifique um numero de CNPJ inválido."); // Mensagem padrão

$.validator.addMethod( "Cpf", function( value ) {

    return validarCpf(value);

}, "Por favor especifique um número de CPF Válido" );


function validarCpfCnpj(value){
    value = value.replace( /([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "");
    console.log(value);
    if(value.length === 11){
        return validarCpf(value)
    }else if(value.length === 14){
        return validarCnpj(value)
    }else{
        return false;
    }
}