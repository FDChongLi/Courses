package com.lab4.demo.model;

public class ResponseBean {
    // http 状态码
    private int code;
    // 返回信息
    private String msg;
    // 返回的数据
    private Object data;

    public ResponseBean(int code, String msg, Object data) {
        this.code = code;
        this.msg = msg;
        this.data = data;
    }

    public int getCode() {
        return code;
    }

    public ResponseBean setCode(int code) {
        this.code = code;
        return this;
    }

    public String getMsg() {
        return msg;
    }

    public ResponseBean setMsg(String msg) {
        this.msg = msg;
        return this;
    }

    public Object getData() {
        return data;
    }

    public ResponseBean setData(Object data) {
        this.data = data;
        return this;
    }
}