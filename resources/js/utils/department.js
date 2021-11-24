import store from '@/store';

/**
 * @param {Array} value
 * @returns {Boolean}
 * @example see @/views/permission/Directive.vue
 */
export default function checkDepartment(value) {
  if (value && value instanceof Array && value.length > 0) {
    const department = store.getters && store.getters.department;
    const requiredDepartments = value;

    const hasDepartment = requiredDepartments.some(d => d === department);

    return hasDepartment;
  } else {
    console.error('Need department');
    return false;
  }
}
