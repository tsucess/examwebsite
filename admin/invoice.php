<?php
include './partials/header.php';
?>

    <section class="invoice_section">
        <div class="container invoice_section-container">
            <h2>Invoice</h2>
             <form action="">
                    <table class="invoice">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Fee (MYR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0417</td>
                                <td>Mathematics</td>
                                <td>850.00</td>
                            </tr>
                            <tr>
                                <td>0450</td>
                                <td>Information and Communication Technology</td>
                                <td>750.00</td>
                            </tr>
                            <tr>
                                <td>0412</td>
                                <td>Biology</td>
                                 <td>700.00</td>
                            </tr>
                            <tr>
                                <td>20411</td>
                                <td>Business Studies</td>
                                 <td>750.00</td>
                            </tr>
                            <tr>
                                <td>0412</td>
                                <td>Information and Communication Technology(Practical)</td>
                                <td>700.00</td>
                            </tr>
                            <tr >
                                <td colspan="2"><b>Total</b></td>
                                <td ><b>3750.00</b></td>
                                                  
                            </tr>
                        </tbody>
                    </table>
                    <a href="edit-user.php" class="btn btn-edit">Download</a>
                </form>
            
        </div>
    </section>

    <script src="./js/main.js"></script>
</body>

</html>