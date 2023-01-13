<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>IOT</title>
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <?php
    include 'conn.php';

    ?>
    <div class="page-template" id="content">
        <img src="assets/img/header.png" alt="header">
        <h2>Decharge</h2>
        <p>
            Je soussignee <b><?php echo $_POST['admin_name']; ?></b>, certefice a donne le composant <b><?php echo $_POST['component']; ?></b> en quantite de <b><?php echo $_POST['quantity']; ?></b> a l'etudiant/e <b><?php echo $_POST['student']; ?></b>
        </p>
        <div class="foot">
            <p>Fait le <b><?php echo $_POST['date']; ?></b> a SBA</p>
            <p>singature</p>
        </div>
    </div>

    <script src="assets/js/jspdf.min.js"></script>

    <script>
        var opt = {
            margin: 1, //top, left, bottom, right,
            jsPDF: {
                unit: 'pt',
                format: 'a4',
                html2canvas: {
                    dpi: 96,
                    scale: 1
                },
                pagebreak: {
                    mode: 'avoid-all'
                },
                orientation: 'portrait'
            }
        };
        const element = document.getElementById("content");
        html2pdf()
            .set(opt)
            .from(element)
            .save("discharge-letter.pdf");
    </script>
</body>

</html>