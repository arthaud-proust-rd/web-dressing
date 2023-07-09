import {
    createElementBlock as _createElementBlock,
    createElementVNode as _createElementVNode,
    openBlock as _openBlock
} from "vue";

export default function render(_ctx, _cache) {
    return (_openBlock(), _createElementBlock("svg", {
        xmlns: "http://www.w3.org/2000/svg",
        fill: "none",
        viewBox: "0 0 24 24",
        "stroke-width": "1.5",
        stroke: "currentColor",
        "aria-hidden": "true"
    }, [
        _createElementVNode("path", {
            "stroke-linecap": "round",
            "stroke-linejoin": "round",
            d: "M10 6.49996C14 2.49992 17 9.49997 12 9.49997V12M4.69698 16.126C2.83098 17.626 2.91398 19.5 4.64498 19.5H19.355C21.085 19.5 21.168 17.626 19.303 16.126C17.438 14.626 15.815 13.5 13.949 13C12.083 12.5 11.917 12.5 10.051 13C8.18498 13.5 6.56298 14.626 4.69698 16.126Z"
        })
    ]))
}
