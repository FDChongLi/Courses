package com.lab4.demo.controller;

import com.fasterxml.jackson.databind.util.JSONPObject;
import com.lab4.demo.model.ResponseBean;
import com.lab4.demo.model.User;
import com.lab4.demo.model.UserLoginRequest;
import com.lab4.demo.model.UserRegisterRequest;
import com.lab4.demo.util.EncryptService;
import com.lab4.demo.util.ResultGenerator;
import com.lab4.demo.util.SqlSessionLoader;
//import org.apache.ibatis.session.SqlSession;
import org.springframework.web.bind.annotation.*;

import javax.annotation.Resource;
import java.io.IOException;
import java.util.List;

@RestController
@RequestMapping("/user")
public class UserController {
    @Resource
    private EncryptService encryptService;


//    @RequestMapping(value = "/register", method = RequestMethod.POST)
//    public ResponseBean register(@RequestBody UserRegisterRequest request) throws IOException {
//        SqlSession sqlSession = SqlSessionLoader.getSqlSession();
//        User user = sqlSession.selectOne("example.UserMapper.findUserByUsername",request.getUsername());
//
//        if (user != null) {
//            sqlSession.close();
//            return ResultGenerator.genFailResult("The username is already used");
//        } else {
//            if(request.getPassword().length()<3){
//                sqlSession.close();
//                return ResultGenerator.genFailResult("The password is too short!");
//            }
//            sqlSession.insert("example.UserMapper.addUser", new User( request.getUsername(), request.getPassword(),
//                                                                         request.getEmail(), request.getPhone()));
//            sqlSession.commit();
//            sqlSession.close();
//            user = new User(request.getUsername(),request.getPassword(),request.getEmail(),request.getPhone());
//            return ResultGenerator.genSuccessResult(encryptService.getToken(user)).setMsg("Register pass!");
//        }
//    }
//
//    @RequestMapping(value = "/login", method = RequestMethod.POST)
//    public ResponseBean login(@RequestBody UserLoginRequest request) throws IOException {
//        SqlSession sqlSession = SqlSessionLoader.getSqlSession();
//        User user = sqlSession.selectOne("example.UserMapper.findUserByUsername",request.getUsername());
//        sqlSession.close();
//
//        if (user == null) {
//            return ResultGenerator.genFailResult("The username is error");
//        } else {
//            if(!user.getPassword().equals(request.getPassword())){
//                return ResultGenerator.genFailResult("The password is error");
//            }
//            return ResultGenerator.genSuccessResult(encryptService.getToken(user)).setMsg("Login pass!");
//        }
//    }
//
//    @RequestMapping(value = "/list", method = RequestMethod.GET)
//    public ResponseBean list(@RequestParam String token) throws IOException {
//        if(!encryptService.checkToken(token)){
//            return ResultGenerator.genFailResult("Token error");
//        }
//
//        SqlSession sqlSession = SqlSessionLoader.getSqlSession();
//        List<User> users = sqlSession.selectList("example.UserMapper.findAllUsers");
//        sqlSession.close();
//
//        if (users.size()==0) {
//            return ResultGenerator.genFailResult("The user list is empty");
//        } else {
//            return ResultGenerator.genSuccessResult(users).setMsg("User list");
//        }
//    }
}
