import { login, logout, getInfo } from '@/api/auth';
import { isLogged, setLogged, removeToken } from '@/utils/auth';
import router, { resetRouter } from '@/router';
import store from '@/store';

const state = {
  id: null,
  user: null,
  token: isLogged(),
  name: '',
  avatar: '',
  introduction: '',
  roles: [],
  permissions: [],
  birthday: '',
  joinDate: '',
  address: '',
  username: '',
  gender: '',
  jwtToken: '',
};

const mutations = {
  SET_ID: (state, id) => {
    state.id = id;
  },
  SET_TOKEN: (state, token) => {
    state.token = token;
  },
  SET_INTRODUCTION: (state, introduction) => {
    state.introduction = introduction;
  },
  SET_NAME: (state, name) => {
    state.name = name;
  },
  SET_AVATAR: (state, avatar) => {
    state.avatar = avatar;
  },
  SET_ROLES: (state, roles) => {
    state.roles = roles;
  },
  SET_PERMISSIONS: (state, permissions) => {
    state.permissions = permissions;
  },
  SET_BIRTHDAY: (state, birthday) => {
    state.birthday = birthday;
  },
  SET_JOIN_DATE: (state, joinDate) => {
    state.joinDate = joinDate;
  },
  SET_ADDRESS: (state, address) => {
    state.address = address;
  },
  SET_USERNAME: (state, username) => {
    state.username = username;
  },
  SET_GENDER: (state, gender) => {
    state.gender = gender;
  },
  SET_JWT_TOKEN: (state, jwtToken) => {
    state.jwtToken = jwtToken;
  },
};

const actions = {
  // user login
  login({ commit }, userInfo) {
    const { username, password } = userInfo;
    return new Promise((resolve, reject) => {
      login({ username: username.trim(), password: password })
        .then(response => {
          setLogged('1');
          resolve();
        })
        .catch(error => {
          console.log(error);
          reject(error);
        });
    });
  },

  // get user info
  getInfo({ commit, state }) {
    return new Promise((resolve, reject) => {
      getInfo()
        .then(response => {
          const { data } = response;

          if (!data) {
            reject('Verification failed, please Login again.');
          }

          const {
            roles,
            name,
            avatar,
            introduction,
            permissions,
            id,
            username,
            address,
            joinDate,
            jwtToken,
            gender,
            birthday,
          } = data;
          // roles must be a non-empty array
          if (!roles || roles.length <= 0) {
            reject('getInfo: roles must be a non-null array!');
          }

          commit('SET_ROLES', roles);
          commit('SET_PERMISSIONS', permissions);
          commit('SET_NAME', name);
          commit('SET_AVATAR', avatar);
          commit('SET_INTRODUCTION', introduction);
          commit('SET_ID', id);
          commit('SET_GENDER', gender);
          commit('SET_USERNAME', username);
          commit('SET_BIRTHDAY', birthday);
          commit('SET_ADDRESS', address);
          commit('SET_JOIN_DATE', joinDate);
          commit('SET_JWT_TOKEN', jwtToken);

          resolve(data);
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  // user logout
  logout({ commit }) {
    return new Promise((resolve, reject) => {
      logout()
        .then(() => {
          commit('SET_TOKEN', '');
          commit('SET_ROLES', []);
          removeToken();
          resetRouter();
          resolve();
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  // remove token
  resetToken({ commit }) {
    return new Promise(resolve => {
      commit('SET_TOKEN', '');
      commit('SET_ROLES', []);
      removeToken();
      resolve();
    });
  },

  // Dynamically modify permissions
  changeRoles({ commit, dispatch }, role) {
    return new Promise(async resolve => {
      // const token = role + '-token';

      // commit('SET_TOKEN', token);
      // setLogged(token);

      // const { roles } = await dispatch('getInfo');

      const roles = [role.name];
      const permissions = role.permissions.map(permission => permission.name);
      commit('SET_ROLES', roles);
      commit('SET_PERMISSIONS', permissions);
      resetRouter();

      // generate accessible routes map based on roles
      const accessRoutes = await store.dispatch('permission/generateRoutes', {
        roles,
        permissions,
      });

      // dynamically add accessible routes
      router.addRoutes(accessRoutes);

      resolve();
    });
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
