/**
 *
 * @author: N3 S.r.l.
 */

class ContactModel extends Contact {
    constructor() {
        super();
    }
    get(id = null, ...callBack) {
        if (id !== null) {
            let endpoint = this.endpointBase + '/' + id;
            getAjax(this, endpoint, ...callBack);
        } else {
            let helper = new ContactModel(this.version);
            let obj = this;
            $.each(helper, function (index, value) {
                obj[index] = value;
            });
            callBack.forEach(s => s.apply());
        }
    }

    getUserId(id, prnode, ...callBack) {
        if (id !== null) {
            let endpoint = this.endpointBase + '/' + id;
            let helper = new PersonModel(this.version);
            //let obj = prnode;
            var f = function () {
                //obj.refered_to = helper.id;
                prnode.refered_to = helper.idPerson;
                if ((helper.first_name === null) && (helper.last_name === null)) {
                    core_person.first_name = '';
                    core_person.last_name = '';
                }
                else {
                    core_person.first_name = helper.first_name;
                    core_person.last_name = helper.last_name;
                }
                callBack.forEach(s => s.apply());
            }
            getAjax(helper, endpoint, f);

        }

    }
    insert(...callBack) {
        let endpoint = this.endpointBase + '';
        let obj = this.parseToObj;
        let json = JSON.stringify(obj);
        postAjax(this, endpoint, json, ...callBack);
    }
    update(...callBack) {
        let endpoint = this.endpointBase + '';
        let obj = this.parseToObj;
        let json = JSON.stringify(obj);
        putAjax(this, endpoint, json, ...callBack);
    }
    erase(id = null, ...callBack) {
        let endpoint = this.endpointBase + '';
        let helper = new PersonModel(this.version);
        helper.endpoint = this.endpoint;
        helper.idPerson = id;
        let obj = helper.parseToObj;
        let json = JSON.stringify(obj);
        patchAjax(this, endpoint, json, ...callBack);
    }
    delete(id = null, ...callBack) {
        let endpoint = this.endpointBase + '';
        let helper = new PersonModel(this.version);
        helper.endpoint = this.endpoint;
        helper.idPerson = id;
        let obj = helper.parseToObj;
        let json = JSON.stringify(obj);
        deleteAjax(this, endpoint, json, ...callBack);
    }
    get parseToObj() {
        let obj = {
            id: this.idPerson,
            oid: this.oid,
            title: this.title,
            first_name: this.first_name,
            middle_name: this.middle_name,
            last_name: this.last_name,
            suffix: this.suffix,
            company: this.company,
            job_title: this.job_title,
            email: this.email,
            web_page_address: this.web_page_address,
            im_address: this.im_address,
            phone: this.phone,
            address: this.addressPerson,
            postcode: this.postcodePerson,
            number: this.number,
            city: this.cityPerson,
            province: this.provincePerson,
            country: this.countryPerson,
            timezone: this.timezone,
            new_password: this.new_password,
            group_id: this.group_id,
            is_station_referer: this.is_station_referer,
            is_administrator: this.is_administrator
        };
        return obj;
    }
    parseJsonToObj(context_, json, ...callBack) {
        let obj_full = JSON.parse(json);
        let obj = obj_full.data;
        let context = context_;
        context.idPerson = obj.id;
        context.oid = obj.oid;
        context.title = obj.title;
        context.first_name = obj.first_name;
        context.middle_name = obj.middle_name;
        context.last_name = obj.last_name;
        context.suffix = obj.suffix;
        context.company = obj.company;
        context.job_title = obj.job_title;
        context.email = obj.email;
        context.web_page_address = obj.web_page_address;
        context.im_address = obj.im_address;
        context.phone = obj.phone;
        context.addressPerson = obj.address;
        context.postcodePerson = obj.postcode;
        context.number = obj.number;
        context.cityPerson = obj.city;
        context.provincePerson = obj.province;
        context.countryPerson = obj.country;
        context.timezone = obj.timezone;
        context.new_password = obj.new_password;
        context.group_id = obj.group_id,
            context.is_station_referer = obj.is_station_referer;
        context.is_administrator = obj.is_administrator;
        //callback
        callBack.forEach(s => s.apply());
    }
}
function setPersonVisibility() {

    let core_person_visibility = new Person();

    core_person_visibility.idPerson = true;
    core_person_visibility.oid = true;
    core_person_visibility.title = true;
    core_person_visibility.first_name = true;
    core_person_visibility.middle_name = true;
    core_person_visibility.last_name = true;
    core_person_visibility.suffix = true;
    core_person_visibility.company = true;
    core_person_visibility.job_title = true;
    core_person_visibility.email = true;
    core_person_visibility.web_page_address = true;
    core_person_visibility.im_address = true;
    core_person_visibility.phone = true;
    core_person_visibility.addressPerson = true;
    core_person_visibility.postcodePerson = true;
    core_person_visibility.number = true;
    core_person_visibility.cityPerson = true;
    core_person_visibility.provincePerson = true;
    core_person_visibility.countryPerson = true;
    core_person_visibility.timezone = true;
    core_person_visibility.modified_by = true;
    core_person_visibility.created_by = true;
    core_person_visibility.assigned = true;
    core_person_visibility.create_date = true;
    core_person_visibility.valid_from = true;
    core_person_visibility.valid_to = true;
    core_person_visibility.erased = true;
    core_person_visibility.is_station_referer = true;
    core_person_visibility.is_administrator = true;
    core_person_visibility.last_update = true;


    $.each(core_person_visibility, function (key, value) {
        if (!value)
            $("." + $.md5(key)).hide();
    });
}

