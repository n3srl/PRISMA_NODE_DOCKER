/**
*
* @author: N3 S.r.l.
*/

class ConfigParameters extends N3Obj{
	constructor(){
		super("1","prismaCore","configparameters");
		this.general_quiet = null;
		this.general_on_error = null;
		this.general_except = null;
		this.image_report_photo = null;
		this.daily_report_astro = null;
		this.daily_histo = null;
		this.monthly_report_astro = null;
		this.monthly_histo = null;
		this.event_fill_frames = null;
		this.event_recenter = null;
		this.event_box_bolide = null;
		this.event_model_psf = null;
		this.event_model_bar = null;
		this.event_report = null;
		this.event_image = null;
		this.event_video = null;
	}
}


