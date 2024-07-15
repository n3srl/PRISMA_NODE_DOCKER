/**
 *
 * @author: N3 S.r.l.
 */

let contactLogic = {
    save: function (obj, ...callBack) {
        obj.group_id = 1;
        saveClass(obj, ...callBack);
    },
    get: function (obj, id, ...callBack) {
        obj.group_id = 1;
        getClass(obj, id, ...callBack);
    },
    remove: function (obj, id, safeDelete, ...callBack) {
        removeClass(obj, id, safeDelete, ...callBack);
    },
    getUser: function(obj, prnode, id, ...callback) {
        getPersonId(obj, prnode, id, ...callback);
    }
};

