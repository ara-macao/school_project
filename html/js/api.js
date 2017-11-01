function apiRequest(action, data, callback) {
    $.post("api/?action="+action, data, callback);
    
}