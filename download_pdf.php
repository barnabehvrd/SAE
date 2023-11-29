<?php
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename=bill.pdf');

echo '%PDF-1.3
1 0 obj
<< /Type /Catalog
/Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages
/Kids [3 0 R]
/Count 1 >>
endobj
3 0 obj
<< /Type /Page
/Parent 2 0 R
/MediaBox [0 0 612 792]
/Resources << /Font << /F1 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >> >> >>
/Contents 4 0 R >>
endobj
4 0 obj
<< /Length 190 >>
stream
BT
/F1 18 Tf
50 750 Td
(Bon de Commande) Tj
/F1 12 Tf
50 730 Td
(--------------------------------------------) Tj
50 710 Td
(Produit 1 : T-shirt) Tj
50 690 Td
(Quantité : 5) Tj
50 670 Td
(Prix unitaire : $10) Tj
50 650 Td
(--------------------------------------------) Tj
50 630 Td
(Produit 2 : Tomates) Tj
50 610 Td
(Quantité : 5) Tj
50 590 Td
(Prix unitaire : $10) Tj
50 570 Td
(--------------------------------------------) Tj
50 550 Td
(Total : $100) Tj
ET
endstream
endobj
xref
0 5
0000000000 65535 f 
0000000018 00000 n 
0000000077 00000 n 
0000000178 00000 n 
0000000565 00000 n 
trailer
<< /Root 1 0 R
/Size 5 >>
startxref
589
%%EOF
';
?>
