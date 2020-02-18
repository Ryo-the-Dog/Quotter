// CSRF対策のためクッキーの値を取得する
/**
 * クッキーの値を取得する
 * @param {String} searchKey 検索するキー
 * @returns {String} キーに対応する値
 */
export function getCookieValue (searchKey) {
    if (typeof searchKey === 'undefined') {
        return ''
    }

    let val = ''

    document.cookie.split(';').forEach(cookie => { /* document.cookie によって
                                                           name=12345;token=67890;key=abcde の形で参照する。
                                                           それを; で split してさらに = で split することで
                                                           引数の searchKey と一致するものを探している。 */
        const [key, value] = cookie.split('=')
        if (key === searchKey) {
            return val = value
        }
    })

    return val
}
