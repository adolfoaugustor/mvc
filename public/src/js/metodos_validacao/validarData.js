/*  Como usar a validação de data?
    recebe os valores do campo
    var dataInicial = $("#filtroMultas input[name=data1]").val();
    var dataFinal = $("#filtroMultas input[name=data2]").val();

    Passa na função
    Ex: validarData(dataInicial, dataFinal);
    a função já retorna true ou false caso data esteja inválida ou dataInicial menor que dataFinal,
    retornando mensagens informativas.
 */
function validarData(value1, value2){
    let data1 = value1;
    let data2 = value2;

    if (data1 == "" || data2 == "") {
        alert('Campo data vazio" Favor preencher os dois campos. \n Ex: 10/10/2018');
        jQuery('#filtroMultas input[name=data2]').focus();
        return false;
    }

    data1 = new Date (data1);
    data2 = new Date (data2);
    if (data1 > data2) {
        alert("A data final não pode ser maior que a primeira data");
        jQuery('#filtroMultas input[name=data2]').focus();
        return false;

    } else {
        return true;
    }
}