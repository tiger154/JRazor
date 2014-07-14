function Hash() {
    var _hash = new Array();
    var _keys = new Array();
    var _count = 0;

    this.keys = function () {
        var ret = new Array();
        var l = _count;
        for (var i = 0; i < l; ++i) {
            ret.push(_keys[i]);
        }
        return ret;
    }

    this.values = function () {
        var ret = new Array();
        var l = _count;
        for (var i = 0; i < l; ++i) {
            var k = _keys[i];
            ret.push(_hash[_keys[i]]);
        }
        return ret;
    }

    this.add = function (key, value) {
        if (typeof (_hash[key]) === 'undefined') {
            _keys.push(key);
            _count++;
        }
        _hash[key] = value;
    }

    this.getItem = function (key) {
        return _hash[key];
    }

    this.setItem = function (key, value) {
        _hash[key] = value;
    }

    this.exists = function (key) {
        return typeof (_hash[key]) != 'undefined';
    }

    this.removeAll = function () {
        _hash = new Array();
        _keys = new Array();
        _count = 0;
    }

    this.count = function () {
        return _count;
    }

    // very slow for now
    this.remove = function (key) {
        var newHash = new Array();
        var newKeys = new Array();
        var l = _keys.length;
        _count = 0;
        for (var i = 0; i < l; ++i) {
            var ik = _keys[i];
            if (ik != key) {
                newKeys.push(ik);
                newHash[ik] = _hash[ik];
                _count++;
            }
        }
        _hash = newHash;
        _keys = newKeys;
    }
}