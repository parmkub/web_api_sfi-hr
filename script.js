document.getElementById("make-pdf").addEventListener("click",makePdf);

function makePdf(){
    var docDefinition = {
        content:[
            {text:"Sarabun Thai font ทดสอบภาษาไทย"},
            {text:"Sarabun Thai font ทดสอบภาษาไทยตัวหนา", bold:true},
            {text:"Sarabun Thai font ทดสอบภาษาไทยตัวเอียง", bold:true}
        ]
    };
    pdfMake.createPdf(docDefinition).open();
}