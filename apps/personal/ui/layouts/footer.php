<script>
    // function to reload the page when the button is clicked
    document.getElementById("reload").addEventListener("click", function (e) {
        e.preventDefault(); // Prevent the default link behavior
        //alert without button
        alert("Reloading the page");
        
        location.reload();
    });

    function windowpop(url, width, height) {
        var left = (screen.width - width);
        var top = (screen.height / 2) - (height / 2);
        window.open(url, "", "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left);
    }

    document.getElementById("openLink").addEventListener("click", function (e) {
        e.preventDefault(); // Prevent the default link behavior
        window.open(this.href, "_blank");
    });



    // Function to enable dark mode
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
    }

    // Function to enable light mode
    function enableLightMode() {
        document.body.classList.remove('dark-mode');
    }

    // Add click event listeners to the buttons
    document.getElementById('darkMode').addEventListener('click', enableDarkMode);
    document.getElementById('lightMode').addEventListener('click', enableLightMode);


    // Print Button Click Event
    const printButton = document.getElementById('printContent');
    printButton.addEventListener('click', function () {
        const content = document.querySelector('.content');

        if (window.print) {
            // Modern browsers supporting window.print()
            window.print();
        } else {
            // For browsers that don't support window.print(), open a new window
            const printWindow = window.open('', '_blank');

            // Write the content to the new window
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write('<div class="content">' + content.innerHTML + '</div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Call the print function in the new window
            printWindow.print();

            // Close the new window after printing
            printWindow.close();
        }
    });


    


</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
    crossorigin="anonymous"></script>

</body>

</html>