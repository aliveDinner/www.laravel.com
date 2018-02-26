var Helper = function () {
};

/**
 * 对象参数转字符串
 * @param options
 * @returns {string}
 */
Helper.prototype.param = function (options) {
    var _param = '';
    for (var k in options) {
        _param += k + '=' + options[k] + '&';
    }
    return _param;
};

window.heler = new Helper();