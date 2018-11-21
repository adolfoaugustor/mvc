jQuery.validator.addMethod("uppercase", function(value, element)
{
    return this.optional(element) || /^[A-Z]/.test(value);
}, "Somente Letras em caixa alta");