<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<title>IOT</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
	<link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>

	<iframe name="votar" style="position:absolute; top: -10000px;overflow:hidden">
	</iframe>
	<!-- The Modal -->
	<div id="formModal" class="modal">

		<!-- Modal content -->
		<div class="modal-content ">
			<button id="close">X</button>
			<form action="" method="post" id="newForm" target="" enctype="multipart/form-data">
				<input name="id" hidden>
				<input name="image" hidden>
				<input name="extension" hidden>
				<div class="photo">
					<label>
						<span>Change Image</span>
					</label>
					<input id="imageUpload" type="file" name="photo" accept="image/jpeg, image/png" hidden />
					<img id="output" />
				</div>
				<label for="name">name</label>
				<input name="name" type="text" required>
				<label for="purshased_at">purshase date</label>
				<input name="purshased_at" type="date" required>
				<label for="quantity">quantity</label>
				<input name="quantity" type="number" required>
				<label for="state">state</label>
				<select name="state">
					<option value="lost">Lost</option>
					<option value="available" selected>Available</option>
					<option value="broken">Broken</option>
				</select>
				<input type="submit" value="Validate">
			</form>
		</div>

	</div>
	<div id="DModal" class="modal">

		<!-- Modal content -->
		<div class="modal-content ">
			<button id="closeD">X</button>
			<form action="print.php" method="post" id="DForm" target="votar">
				<input name="id" hidden>
				<label for="admin_name">responsable</label>
				<input name="admin_name" type="text" required>
				<label for="student">Student</label>
				<input name="student" type="text" required>
				<label for="date">date</label>
				<input name="date" type="date" required>
				<label for="component">component</label>
				<select name="component" id="component">
				</select>
				<label for="quantity">quantity</label>
				<input name="quantity" type="number" required>
				<input type="submit" value="Validate">
			</form>
		</div>

	</div>
	<img class="bg" src="./assets/img/bg.jpg" alt="background">
	<nav>
		<a href="index.php">
			IOT
		</a>
		<div style="align-items: center;">

			<button id="add" onclick="addition()">
				Add New Component
			</button>
		</div>
		<div style="align-items: center;">

			<button id="add" onclick="discharge()">
				Discharge
			</button>
		</div>
		<form id="searchForm">
			<h2 style="align-items:center">Filter <img src="assets/img/icons/funnel.svg" style="width:20px !important;height:20px;margin:0px 5px !important"></h2>
			<input type="text" name="q">
			<select name="state">
				<option value="" selected>all</option>
				<option value="lost">Lost</option>
				<option value="available">Available</option>
				<option value="broken">Broken</option>
			</select>
			<select name="date">
				<option value="" selected>None</option>
				<option value="DESC">Latest</option>
				<option value="ASC">Oldest</option>
			</select>
			<button type="submit">
				Search
			</button>
		</form>
		<div style="align-items: center;">

			<button id="add" onclick="excel_export()">
				Export Excel
			</button>
		</div>
	</nav>
	<div class="main">
		<div class="container">

			<div class="row" style="width: 900px;">
				<div class="heading">
					Tous les composants electroniques
				</div>
			</div>


			<div id="components">
			</div>

		</div>
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.min.js"></script>

	<script>
		var global_data;
		var all_data;

		$.ajax({
			url: "components.php",
			method: "GET",
			success: function(data) {
				data = jQuery.parseJSON(data);
				global_data = data;
				all_data = data.map(function(value) {
					return value['state'] === 'available' ? value : null;
				});
				var html_to_append = '';
				$.each(data, function(i, value) {
					if (value) {
						html_to_append += `
					<div class="card" id="${i+1}">
						<div class="row">
							<div class="col">
								<img class="product" src="data:` + value['extension'] + `;base64,` + value['image'] + `">
							</div>
						</div>
						<div class="row">
							<div class="col">

								<h3>${value['name']}</h3>
							</div>
							<div class="col">
								<div class="row action">
									<a onclick="edition(this)" data-arg="${i+1}">
										<img src="assets/img/icons/pencil-fill.svg">
									</a>
									<a href="delete.php?id=${value['id']}">
										<img src="assets/img/icons/trash.svg">
									</a>
								</div>

							</div>

						</div>
						<div class="row">

							<div class="col">

								<span class="date">${value['purshased_at'] }</span>
								<p>${value['quantity'] }</p>
								<p class="${value['state']}">${value['state']} </p>
							</div>
						</div>
					</div>
					`;
					}
				});
				$("#components").html(html_to_append);
			},
		});
		$(".photo label").click(function(e) {
			$("#imageUpload").click();
		});

		async function fasterPreview(uploader) {
			if (uploader.files && uploader.files[0]) {
				let file = uploader.files[0];
				$('#output').attr('src',
					window.URL.createObjectURL(file));
				$('input[name="image"]').val(new Blob(await file.arrayBuffer()));
				$('input[name="extension"]').val(file.type);
			}
		}

		$("#imageUpload").change(function() {
			fasterPreview(this);
		});




		var modal = document.getElementById("formModal");
		var modalD = document.getElementById("DModal");
		// Get the <span> element that closes the modal
		var span = document.getElementById("close");

		var spanD = document.getElementById("closeD");

		var form = document.getElementById("newForm");
		var formD = document.getElementById("DForm");

		// When the user clicks on the button, open the modal
		const edition = (element) => {
			component = global_data[element.getAttribute("data-arg") - 1];
			console.log(component);
			var keys = ['id', 'name', 'image', 'purshased_at', 'quantity', 'extension'];
			for (key of keys) {
				$('input[name="' + key + '"]').val(component[key]);
				$('input[name="' + key + '"]').attr('value', component[key]);
			}

			$('#output').attr('src', "data:" + component['extension'] + ";base64," + component['image']);
			$('select[name="state"]').val(component['state']);
			$('select[name="state"]').attr(component['state']);
			form.setAttribute('action', "edit.php");
			modal.style.display = "flex";
		}
		const addition = () => {
			var keys = ['name', 'purshased_at', 'quantity', ];
			for (key of keys) {
				$('input[name="' + key + '"]').val("");
				$('input[name="' + key + '"]').attr('value', "");
			}
			$('select[name="state"]').val("available");
			$('select[name="state"]').attr('value', "available");
			$('#output').attr('src', "");
			form.setAttribute('action', "add.php")
			modal.style.display = "flex";
		}
		const discharge = () => {
			var html_to_append = '';
			$.each(all_data, function(i, value) {
				if (value) {
					html_to_append += `
						<option value="${value['name']}">${value['name']}</option>
					`;
				}

			});
			$("#component").html(html_to_append);
			var keys = ['admin_name', 'student', 'quantity', 'date'];
			for (key of keys) {
				$('input[name="' + key + '"]').val("");
				$('input[name="' + key + '"]').attr('value', "");
			}
			modalD.style.display = "flex";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			var keys = ['name', 'purshased_at', 'quantity', ];
			for (key of keys) {
				$('input[name="' + key + '"]').val("");
				$('input[name="' + key + '"]').attr('value', "");
			}
			$('select[name="state"]').val("available");
			$('select[name="state"]').attr('value', "available");
			$('#output').attr('src', "");
			modal.style.display = "none";
		}
		spanD.onclick = function() {
			var keys = ['admin_name', 'student', 'quantity', 'date'];
			for (key of keys) {
				$('input[name="' + key + '"]').val("");
				$('input[name="' + key + '"]').attr('value', "");
			}
			modalD.style.display = "none";
		}
		$("#searchForm").submit(function(event) {

			if (event) {
				event.preventDefault();
			}
			form = $("#searchForm");

			$.ajax({
				url: "search.php",
				method: "GET",
				data: form.serialize(),
				success: function(data) {
					data = jQuery.parseJSON(data);
					global_data = data;
					var html_to_append = '';
					$.each(data, function(i, value) {
						html_to_append += `
						<div class="card" id="${i+1}">
						<div class="row">
							<div class="col">
								<img class="product" src="data:` + value['extension'] + `;base64,` + value['image'] + `">
							</div>
						</div>
						<div class="row">
							<div class="col">

								<h3>${value['name']}</h3>
							</div>
							<div class="col">
								<div class="row action">
									<a onclick="edition(this)" data-arg="${i+1}">
										<img src="assets/img/icons/pencil-fill.svg">
									</a>
									<a href="delete.php?id=${value['id']}">
										<img src="assets/img/icons/trash.svg">
									</a>
								</div>

							</div>

						</div>
						<div class="row">

							<div class="col">

								<span class="date">${value['purshased_at'] }</span>
								<p>${value['quantity'] }</p>
								<p class="${value['state']}">${value['state']} </p>
							</div>
						</div>
					</div>
					`;
					});
					$("#components").html(html_to_append);
				},
				error: function() {
					console.log(data);
				}
			});
		});

		function excel_export() {
			let i = 0;
			data = global_data.map((value) => {
				return {
					'id': i++,
					'name': value['name'],
					'quantity': value['quantity'],
					'purshased date': value['purshased_at'],
					'state': value['state'],
				}
			});
			var x = new CSVExport(data);
		}
	</script>

</body>

</html>