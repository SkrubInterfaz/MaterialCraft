function securPass()
{
	$("#progress").removeClass("d-none");
	result = zxcvbn($("#MdpInscriptionForm").val());
	if (result['score'] == 0)
	{
		$("#progressbar").addClass("bg-danger");
		$("#progressbar").css('width', '0%');
		$("#progressbar").attr('aria-valuenow', '0');
	}
	else if (result['score'] == 1)
	{
		if ($("#progressbar").hasClass("orange"))
			$("#progressbar").removeClass("orange");
		else if ($("#progressbar").hasClass("green"))
			$("#progressbar").removeClass("green");
		$("#progressbar").addClass("red");
		$("#progressbar").css("width", "25%");
		$("#progressbar").attr("aria-valuenow", "25");
	}
	else if (result['score'] == 2)
	{
		if ($("#progressbar").hasClass("green"))
			$("#progressbar").removeClass("green");
		else if ($("#progressbar").hasClass("red"))
			$("#progressbar").removeClass("red");
		$("#progressbar").addClass("orange");
		$("#progressbar").css("width", "50%");
		$("#progressbar").attr("aria-valuenow", "50");
	}
	else if (result['score'] == 3)
	{
		if ($("#progressbar").hasClass("orange"))
			$("#progressbar").removeClass("orange");
		else if ($("#progressbar").hasClass("red"))
			$("#progressbar").removeClass("red");
		$("#progressbar").addClass("green");
		$("#progressbar").css("width", "75%");
		$("#progressbar").attr("aria-valuenow", "75");
	}
	else if (result['score'] == 4)
	{
		if ($("#progressbar").hasClass("orange"))
			$("#progressbar").removeClass("orange");
		else if ($("#progressbar").hasClass("red"))
			$("#progressbar").removeClass("red");
		$("#progressbar").addClass("green");
		$("#progressbar").css("width", "100%");
		$("#progressbar").attr("aria-valuenow", "100");
	}
	if($("#MdpInscriptionForm").val() != '' && $("#MdpConfirmInscriptionForm").val() != '')
	{
		if($("#MdpInscriptionForm").val() == $("#MdpConfirmInscriptionForm").val())
		{
            $("#correspondance").addClass("green-text");
			if($("#correspondance").hasClass("red-text"))
				$("#correspondance").removeClass("red-text");
			$("#correspondance").html("Les mots de passes correspondent");
			$("#InscriptionBtn").removeAttr("disabled");
		}
		else
		{
			$("#correspondance").addClass("red-text");
			if($("#correspondance").hasClass("green-text"))
				$("#correspondance").removeClass("green-text");
			$("#correspondance").html("Les mots de passes ne correspondent pas");
		}
		if($("#MdpInscriptionForm").val() != $("#MdpConfirmInscriptionForm").val())
		{
			$("#InscriptionBtn").attr("disabled", true);
		}
	}
	else
	{
		$("#InscriptionBtn").attr("disabled", true);
		$("#correspondance").html("");
	}
}

