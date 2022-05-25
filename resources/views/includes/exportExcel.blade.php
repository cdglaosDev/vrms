<script>
    function fnExcelReport(filename = "VRMS")
    {
        var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange; var j=0;
        tab = document.getElementById('table'); // id of table

        for(j = 0 ; j < tab.rows.length ; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            if(j != tab.rows.length-1){
                tab_text = tab_text+"<tr>";
            }
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }
        else{                 //other browser not tested on IE 11
            a = document.getElementById("excelPrintWithName");
            base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) };
            a.href = 'data:application/vnd.ms-excel;base64,' + base64("<meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\">"+tab_text);
            //setting the file name
            a.download = filename+'.xls';
            //triggering the function
            a.click();
            return 0;
            /*sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            return (sa);*/
        }
    }
</script>
    <iframe id="txtArea1" style="display:none" title="App"></iframe>
    <a id="excelPrintWithName"></a>