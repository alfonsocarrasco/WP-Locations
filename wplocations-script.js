class URIChecker {
    constructor() {
        this.currentURI = window.location.pathname;
        this.checkURI();
    }

    checkURI() {
        const regex = /(catalogo\/[duramil|pro\-rubber]*\/[a-zA-Z0-9\-]*[\/]?)$/;
        const regexCategory = /(categoria\/[duramil|pro\-rubber]*[\/]?)$/;
        const regexCatalogo = /(\/catalogo\/?)((page\/)([0-9]\/))?$/;
        if (regex.test(this.currentURI)) {
            
            let productTittle = document.querySelector('div.single-product-content h1.product_title');
            productTittle.style.padding = '5px';
            productTittle.style.color = 'white';
            productTittle.style.fontSize = '25px';
            productTittle.style.textAlign = 'center';
            
            const brand = /(catalogo\/pro\-rubber*\/[a-zA-Z0-9\-]*[\/]?)$/;
            productTittle.style.backgroundColor = ( brand.test(this.currentURI)  ? '#e72001' : '#31512e');
            
            /*
            const productImages = document.querySelector("div.woo-variation-product-gallery");
            const characteristics = document.querySelector('#product-characteristics');
            characteristics.style.display = "flex";
            characteristics.style.justifyContent = "space-between";
            const iconsCharacteristics = document.querySelector("#iconsCharacteristics");
            const extractor = new CaracteristicasExtractor();
            const txtCharacteristics = extractor.obtenerCaracteristicas('tr.woocommerce-product-attributes-item--attribute_pa_caracteristicas td.woocommerce-product-attributes-item__value > p ');
            */
            
        } else if(regexCatalogo.test(this.currentURI) || regexCategory.test(this.currentURI)) {
            
            let productsList = document.querySelectorAll('div.products .wd-product-cats a');
            let brandsList = {
                'Pro Rubber' : 'https://www.duramil.com.mx/wp-content/uploads/2023/11/prorubber.png',
            'Duramil' : 'https://www.duramil.com.mx/wp-content/uploads/2023/11/duramil.png' };
            
            if (Object.keys(productsList).length > 0) {
               productsList.forEach( data => {
                   let iconBrand = document.createElement('img');
                    iconBrand.src = brandsList[data.innerText];
                    iconBrand.alt = data.innerText;
                    iconBrand.style.width = "35px";
                    iconBrand.style.marginRight = "10px";
                   data.parentNode.insertBefore(iconBrand, data);
               });
            }
            
            let filtroOrden = document.querySelector("div.shop-loop-head .wd-shop-tools:nth-of-type(2)");
            filtroOrden.style.display = "none";
            
            let btnBack = document.querySelector("div.wd-back-btn");
            btnBack.style.display = "none";
            
        }else {
            const cpInput = document.forms.frmAddLocation?.cp;
            if (cpInput) {
                cpInput.addEventListener('input', (event) => {
                    const valor = cpInput.value;
                    const patron = /^\d{5}$/;

                    if (!patron.test(valor)) {
                        cpInput.setCustomValidity("Ingrese un código postal de 5 dígitos (01000-99998)");
                    } else {
                        cpInput.setCustomValidity("");
                    }
                });

                cpInput.addEventListener('blur', (event) => {
                    const valor = cpInput.value;
                    const patron = /^\d{5}$/;

                    if (!patron.test(valor) && valor !== '') {
                        alert("Ingrese un código postal de 5 dígitos (01000-99998)");
                    }
                });
            }
        }
    }
}

class CaracteristicasExtractor {
    constructor() {
        this.caracteristicas = [];
    }

    obtenerCaracteristicas(element) {
        const elementosP = document.querySelectorAll(element);

        elementosP.forEach(elemento => {
            const texto = elemento.textContent.trim();
            const caracteristicasSeparadas = texto.split(', ');
            this.caracteristicas.push(...caracteristicasSeparadas);
        });

        return this.caracteristicas;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    new URIChecker();
});