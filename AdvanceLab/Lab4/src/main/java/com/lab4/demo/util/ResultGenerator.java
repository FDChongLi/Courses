package com.lab4.demo.util;

import com.lab4.demo.model.ResponseBean;

public class ResultGenerator {
    private static final String DEFAULT_SUCCESS_MESSAGE = "SUCCESS";
    private static final String DEFAULT_Fail_MESSAGE = "FAIL";
    private static final int DEFAULT_SUCCESS_CODE = 200;
    private static final int DEFAULT_Fail_CODE = 209;

    public static ResponseBean genSuccessResult() {
        return new ResponseBean(DEFAULT_SUCCESS_CODE,DEFAULT_SUCCESS_MESSAGE,null);
    }

    public static ResponseBean genSuccessResult(Object data) {
        return new ResponseBean(DEFAULT_SUCCESS_CODE,DEFAULT_SUCCESS_MESSAGE,data);
    }

    public static ResponseBean genFailResult() {
        return new ResponseBean(DEFAULT_Fail_CODE,DEFAULT_Fail_MESSAGE,null);
    }

    public static ResponseBean genFailResult(String message) {
        return new ResponseBean(DEFAULT_Fail_CODE,message,null);
    }
}
