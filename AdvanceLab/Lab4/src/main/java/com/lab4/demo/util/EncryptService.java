package com.lab4.demo.util;

import com.lab4.demo.model.User;
//import org.apache.ibatis.session.SqlSession;
import org.springframework.stereotype.Service;

import javax.crypto.Cipher;
import java.security.Key;

@Service
public class EncryptService{
    // 字符串默认键值
    private static String strDefaultKey = "inventec2020@#$%^&";

    //加密工具
    private Cipher encryptCipher = null;

    // 解密工具
    private Cipher decryptCipher = null;

    /**
     * 默认构造方法，使用默认密钥
     */
    public EncryptService() throws Exception {
        this(strDefaultKey);
    }

    /**
     * 指定密钥构造方法
     * @param strKey 指定的密钥
     * @throws Exception
     */
    public EncryptService(String strKey) throws Exception {

        // Security.addProvider(new com.sun.crypto.provider.SunJCE());
        Key key = getKey(strKey.getBytes());
        encryptCipher = Cipher.getInstance("DES");
        encryptCipher.init(Cipher.ENCRYPT_MODE, key);
        decryptCipher = Cipher.getInstance("DES");
        decryptCipher.init(Cipher.DECRYPT_MODE, key);
    }

    /**
     * 将byte数组转换为表示16进制值的字符串， 如：byte[]{8,18}转换为：0813，和public static byte[]
     *
     * hexStr2ByteArr(String strIn) 互为可逆的转换过程
     *
     * @param arrB 需要转换的byte数组
     * @return 转换后的字符串
     * @throws Exception  本方法不处理任何异常，所有异常全部抛出
     */
    public static String byteArr2HexStr(byte[] arrB) throws Exception {
        int iLen = arrB.length;
        // 每个byte用2个字符才能表示，所以字符串的长度是数组长度的2倍
        StringBuffer sb = new StringBuffer(iLen * 2);
        for (int i = 0; i < iLen; i++) {
            int intTmp = arrB[i];
            // 把负数转换为正数
            while (intTmp < 0) {
                intTmp = intTmp + 256;
            }
            // 小于0F的数需要在前面补0
            if (intTmp < 16) {
                sb.append("0");
            }
            sb.append(Integer.toString(intTmp, 16));
        }
        return sb.toString();
    }

    /**
     * 将表示16进制值的字符串转换为byte数组，和public static String byteArr2HexStr(byte[] arrB)
     * 互为可逆的转换过程
     * @param strIn 需要转换的字符串
     * @return 转换后的byte数组
     */
    public static byte[] hexStr2ByteArr(String strIn) throws Exception {
        byte[] arrB = strIn.getBytes();
        int iLen = arrB.length;
        // 两个字符表示一个字节，所以字节数组长度是字符串长度除以2
        byte[] arrOut = new byte[iLen / 2];
        for (int i = 0; i < iLen; i = i + 2) {
            String strTmp = new String(arrB, i, 2);
            arrOut[i / 2] = (byte) Integer.parseInt(strTmp, 16);
        }
        return arrOut;
    }


    /**
     * 从指定字符串生成密钥，密钥所需的字节数组长度为8位 不足8位时后面补0，超出8位只取前8位
     * @param arrBTmp 构成该字符串的字节数组
     * @return 生成的密钥
     */
    private Key getKey(byte[] arrBTmp) throws Exception {
        // 创建一个空的8位字节数组（默认值为0）
        byte[] arrB = new byte[8];
        // 将原始字节数组转换为8位
        for (int i = 0; i < arrBTmp.length && i < arrB.length; i++) {
            arrB[i] = arrBTmp[i];
        }
        // 生成密钥
        Key key = new javax.crypto.spec.SecretKeySpec(arrB, "DES");
        return key;
    }
    /**
     *
     * 加密字节数组
     * @param arrB 需加密的字节数组
     * @return 加密后的字节数组
     */
    private byte[] encrypt(byte[] arrB) throws Exception {
        return encryptCipher.doFinal(arrB);
    }

    /**
     * 解密字节数组
     * @param arrB 需解密的字节数组
     * @return 解密后的字节数组
     */
    public byte[] decrypt(byte[] arrB) throws Exception {
        return decryptCipher.doFinal(arrB);
    }

    public String encrypt(String str) throws Exception {
        return byteArr2HexStr(encrypt(str.getBytes()));
    }

    /**
     * 解密字符串
     * @param strIn 需解密的字符串
     * @return 解密后的字符串
     */
    public String decrypt(String strIn) throws Exception {
        return new String(decrypt(hexStr2ByteArr(strIn)));
    }


    public String getToken(User user){

        String password = user.getPassword();
        String token = user.getUsername()+"_"+System.currentTimeMillis()+"_"+password.substring(password.length()-2);
        String ret;
        try{
            ret = encrypt(token);
        }catch (Exception e){
            System.out.println("Token加密失败");
            System.out.println(e.toString());
            ret = token;
        }
        return ret;
    }

//    public boolean checkToken(String token){
//        String str;
//
//        try{
//            str = decrypt(token);
//        }catch (Exception e){
//            System.out.println("Token解密失败");
//            System.out.println(e.toString());
//            return false;
//        }
//
//        if(str.length()<=4){
//            return false;
//        }
//
//        String p2 = str.substring(str.length()-2);
//        str = str.substring(0,str.length()-3);
//        int index = str.lastIndexOf("_");
//
//        if(index==-1){
//            return false;
//        }
//
//        String userName = str.substring(0,index);
//        User user;
//        try {
//            SqlSession sqlSession = SqlSessionLoader.getSqlSession();
//            user= sqlSession.selectOne("example.UserMapper.findUserByUsername",userName);
//            sqlSession.close();
//        }catch (Exception e){
//            System.out.println("sql session error , find user by user name fail");
//            return false;
//        }
//
//
//        if(user==null){
//            return false;
//        }else{
//
//            String password = user.getPassword();
//            password = password.substring(password.length()-2);
//            if(!password.equals(p2)){
//                return false;
//            }
//        }
//
//        String time = str.substring(index+1);
//
//        long currentTime = System.currentTimeMillis();
//        long frontTime;
//        try {
//            frontTime = Long.parseLong(time);
//        }catch (Exception e){
//            System.out.println("时间格式错误");
//            System.out.println(e.toString());
//            return false;
//        }
//
//        //如果时间超过或在2小时以前则错误
//        if(frontTime>currentTime||frontTime<currentTime-7200000){
//            return false;
//        }
//
//        return true;
//    }
}
