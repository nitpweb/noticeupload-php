<head>
	<link rel="stylesheet" type="text/css" href="./css/new.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/home.css" />
	<script type="text/javascript" src="./js/vm.js"></script>



</head>
<?php include 'body.php';
		include 'User.class.php'
?>

<body>
	<div style="margin-left: 50px;">

		<div class='grid_22' style='margin:20 0 0 110;text-align: justify;' id="important">
			<div id="rhead">Tenders

			</div>
			<br>
			<a href="tendersUpload.php" target="_blank"><button>Upload</button></a>
			<div id="noticepanel" overflow: scroll; class="ex2">

				<?php
				$notices = new Notices();
				$arr = $notices->getNotices(Notices::$TENDER);
				foreach ($arr as $a) {
					// echo "<h3><a target='_blank' href='" . $a['url'] . "'>" . $a['title'] . "</a></h3>";

					echo '<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="' . $a['url'] . '" target="_blank">' . $a['title'] . '</a></span></li>';
				}
				?>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/Dr Subrata Das ched 03.02.2020.pdf" target="_blank"> Tender for the supply of Multichannel Potentiostat Galvanoatat under DST-SERB Project (PI. Dr. Subrata Das) Dept. of Chemistry at NIT Patna</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/tender 22.pdf" target="_blank"> Corrigendum: Tender No. NITP/Proc./19-20/22 Dated 23/12/2019 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/19.pdf" target="_blank"> Corrigendum: Tender no. NITP/Proc/19-20/19 dated 16/12/2019 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/CorrigendumTenderno.NITPProc19-2018dated16122019.pdf" target="_blank"> Corrigendum: Tender no. NITP/Proc/19-20/18 dated 16/12/2019 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/CorrigendumTenderno.NITPProc19-2015 dated25112019.pdf" target="_blank"> Corrigendum : Tender no. NITP/Proc/19-20/15 dated 25/11/2019 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/MusicalInstrumentsNITPatna1.pdf" target="_blank"> Corrigendum for Tender No. NITP/Proc./19-20/21, dated 19/12/19</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/ExtensionofBidOpeningDate.pdf" target="_blank"> Corrigendum for Extension of Bid Opening Date of Tender No. NITP/Proc./19-20/16 dt: 03/12/19 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/LimitedTenderforEMU DivisionNITPatna.pdf" target="_blank"> Corrigendum: Tender for Supply of Electrical Materials for EMU Division at NIT Patna </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/15_ExtensionofBidSubmission.pdf" target="_blank">Extension of last date of bid submission for Tender No. NITP/Proc./19-20/15, Dated: 25.11.2019 </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/NoticeforCancellationofTender.pdf" target="_blank">Cancellation of Tender for engagement of Chartered Accountant Firm</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/TenderforEquipmentfromSEEDTransportationEngglabCED.pdf" target="_blank"> Procurement of equipment for Transportation Lab. of Civil Engg. Dept., NIT Patna</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/TenderforEquipmentfromSEEDGeotechnicallabCED-converted.pdf" target="_blank"> Tender for Procurement of equipments for Geotechnical Lab. at NIT Patna</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/TenderMusic.pdf" target="_blank"> Tender for the supply of Audio Equipment’s/ Musical Instruments for Music Club of NIT Patna</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/ProcurementofequipmentsunderSEED2.pdf" target="_blank"> Procurement of equipments under (SEED) Project of Mechanical Engg. Dept., NIT Patna, Project-PI Dr. Karpagaraj</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/ProcurementofequipmentsunderSEED.pdf" target="_blank"> Procurement of equipments under (SEED) Project of Mechanical Engg. Dept., NIT Patna, Project-PI Dr. Anindya Malas</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/TenderBRRDA.pdf" target="_blank">Tender for Procurement of Equipment’s under (BRRDA) Project PI Prof. Sanjeev Sinha</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/LimitedTenderforProcurementofequipmentsunder(SEED).pdf" target="_blank">Limited Tender for Procurement of equipments under (SEED) Project of Mechanical Engg Dept PI Dr Vimal K E K</a></span></li-->
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/EMUNIT3.pdf" target="_blank">Revised Limited Tender for Supply of Electrical Material for EMU Division at NIT Patna.</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/LimitedTender.pdf" target="_blank">Limited Tender for Procurement of equipments under (SERB/DST) Project of MED, NIT Patna </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/TenderGC.pdf" target="_blank">Tender doc for GI/PC SHEET </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/Transformer_Installation.pdf" target="_blank">Tender for supply and installation of 500 KVA Transformer & Installation of 315 KVA Transformer in NIT Patna.</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/Equipment_Geotechnical_lab.pdf" target="_blank">Tender for supply of Equipment for Geotechnical lab CED., NIT Patna</a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/Optics_Optomechanics_Project.pdf" target="_blank">Tender for supply of Optics and Optomechanics under ECR, DST SERB Project </a></span></li>
				<li><span style="color:#0000ff;font-weight:bold;margin-top:5px;margin-bottom:-5px"><a href="../uploads/Tender for Utariya and jacket.pdf" target="_blank">Tender for Uttariya and Jacket</a></span></li>


			</div>

			<br>

		</div>



</body>
<?php include 'footer.php'; ?>