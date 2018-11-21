jQuery.validator.addMethod("validarNome",function(value){
    
    return /^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª' ]+$/.test(value);

},'O nome não pode conter caracters inválidos');